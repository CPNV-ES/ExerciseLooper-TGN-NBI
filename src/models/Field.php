<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 30.09.2022
    Description: Fields Model Class 
*/

namespace Src\Models;

use Src\Models\Model;
use Src\Models\Exercise;

class Field extends Model
{
    private const TABLE = "fields";
    protected $id;
    protected $title;
    protected $field;
    protected $exerciseId;

    public function __construct($id, $title, $field, $exerciseId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->exerciseId = $exerciseId;
        $this->field = $field;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getField()
    {
        return $this->field;
    }

    public function setField($field)
    {
        $this->field = $field;
    }

    public function sync()
    {
        $this->update(
            self::TABLE,
            ['title', 'field', 'exercises_id'],
            [$this->title, $this->field, $this->exerciseId],
            $this->id
        );
    }

    public static function getAll($where = "")
    {
        $result = [];
        $fields = self::select(self::TABLE, "*", $where);
        foreach ($fields as $field) {
            array_push(
                $result,
                new self(
                    $field['id'],
                    $field['title'],
                    $field['field'],
                    $field['exercises_id'],
                )
            );
        }
        return $result;
    }

    public static function getOne($id)
    {
        $field = self::select(self::TABLE, "*", ["id" => $id])[0];
        if ($field) {
            return new self(
                $field['id'],
                $field['title'],
                $field['field'],
                $field['exercises_id'],
            );
        }
    }

    public static function create($title, $field, $exercise)
    {
        $exerciseId = null;
        $exerciseType = gettype($exercise);
        if ($exerciseType == "integer" || $exerciseType == "string") {
            $exerciseId = $exercise;
        } else {
            $exerciseId = $exercise->getID();
        }

        if ($exerciseId != null) {
            $id = self::insert(self::TABLE, 'title,field,exercises_id', "$title,$field,$exerciseId");
            return new self($id, $title, $field, $exerciseId);
        }
    }

    public function destroy()
    {
        $this->delete(self::TABLE, ["id" => $this->id]);
    }
}
