<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 12.09.2022
    Description: Exercices Model calling Model Class 
*/

namespace Src\Models;

use Src\Models\Model;
use Src\Models\Field;

class Exercise extends Model
{
    private const TABLE = 'exercises';
    protected $id;
    protected $title;
    protected $state;
    protected $fields = [];

    public function __construct($id, $title, $state, $fields = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->state = $state;
        $this->fields = $fields;
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

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function destroy()
    {
        if ($this->state != "Answering") {
            $this->delete(self::TABLE, ["id" => $this->id]);
        }
    }

    public function sync()
    {
        $this->update(
            self::TABLE,
            ['title', 'state'],
            [$this->title, $this->state],
            $this->id
        );
    }

    public static function getAll($where = [])
    {
        $result = [];
        $data = self::select("exercises", "*", $where);
        foreach ($data as $exercise) {
            $fields = Field::getAll(["exercises_id" => $exercise['id']]);
            array_push(
                $result,
                new self(
                    $exercise['id'],
                    $exercise['title'],
                    $exercise['state'],
                    $fields,
                )
            );
        }
        return $result;
    }

    public static function getOne($id)
    {
        $exercise = self::select("exercises", "*", ["id" => $id])[0];
        if ($exercise) {
            $fields = Field::getAll(["exercises_id" => $id]);
            return new self(
                $exercise['id'],
                $exercise['title'],
                $exercise['state'],
                $fields,
            );
        }
    }

    public static function create($title, $state = "Building")
    {
        $id = self::insert(self::TABLE, 'title,state', "$title,$state");
        return new self($id, $title, $state);
    }
}
