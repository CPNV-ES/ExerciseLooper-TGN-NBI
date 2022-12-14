<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 10.10.2022
    Description: Fulfillments Model 
*/

namespace Src\Models;

class Fulfillment extends Model
{
    const TABLE = "fulfillments";
    protected $id;
    protected $date;
    protected $exerciseId;

    public function __construct($id, $date, $exerciseId)
    {
        $this->id = $id;
        $this->date = $date;
        $this->exerciseId = $exerciseId;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public static function getAll($where = "")
    {
        $result = [];
        $fulfillments = self::select(self::TABLE, "*", $where);
        foreach ($fulfillments as $fulfillment) {
            array_push(
                $result,
                new self(
                    $fulfillment['id'],
                    $fulfillment['date'],
                    $fulfillment['exercises_id'],
                )
            );
        }
        return $result;
    }

    public static function getOne($id)
    {
        $fulfillment = self::select(self::TABLE, "*", ["id" => $id])[0];
        if ($fulfillment) {
            return new self(
                $fulfillment['id'],
                $fulfillment['date'],
                $fulfillment['exercises_id'],
            );
        }
    }

    public function getFieldsValues()
    {
        $result = [];
        $fulfillmentsValues = self::select("fields_has_fulfillments", "*", ["fulfillments_id" => $this->id]);
        foreach ($fulfillmentsValues as $value) {
            array_push($result, [
                "field" =>  Field::getOne($value['fields_id']),
                "value" => $value['value']
            ]);
        }
        return $result;
    }

    public function updateFieldsValues($values = [])
    {
        for ($i = 0; $i < count($values); $i += 2) {
            self::update('fields_has_fulfillments', ['value'], [$values[$i + 1]['value']], ["fields_id" => (int) $values[$i]['field_id'], "fulfillments_id" => $this->id]);
        }
    }

    public static function create($date, $exercise, $values = [])
    {
        $exerciseId = null;
        $exerciseType = gettype($exercise);
        if ($exerciseType == "integer" || $exerciseType == "string") {
            $exerciseId = $exercise;
        } else {
            $exerciseId = $exercise->getID();
        }

        if ($exerciseId != null) {
            $id = self::insert(self::TABLE, 'date,exercises_id', "$date,$exerciseId");
            for ($i = 0; $i < count($values); $i += 2) {
                self::insert('fields_has_fulfillments', 'fields_id,fulfillments_id,value', $values[$i]['field_id'] . ",$id," . $values[$i + 1]['value']);
            }
            return new self($id, $date, $exerciseId);
        }
    }


    public function destroy()
    {
        $this->delete(self::TABLE, ["id" => $this->id]);
    }

    public function sync()
    {
        $this->update(
            self::TABLE,
            ['date', 'exercises_id'],
            [$this->date, $this->exercise->getID()],
            $this->id
        );
    }
}
