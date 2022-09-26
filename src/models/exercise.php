<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 12.09.2022
    Description: Exercices Model calling Model Class 
*/

namespace App\Models;


require_once(SOURCE_DIR . '/models/model.php');

use App\Models\Model as Model;

class Exercise extends Model
{
    private const TABLE = 'exercises';
    protected $id;
    protected $title;

    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
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

    public function sync()
    {
        $this->update(
            self::TABLE,
            ['title'],
            [$this->title],
            $this->id
        );
    }

    public static function getAll()
    {
        $result = [];
        $data = self::select("exercises", "*");
        foreach ($data as $exercise) {
            array_push(
                $result,
                new self(
                    $exercise['id'],
                    $exercise['title'],
                )
            );
        }
        return $result;
    }

    public static function create($title)
    {
        $id = self::insert(self::TABLE, 'title', $title);
        return new self($id, $title);
    }
}
