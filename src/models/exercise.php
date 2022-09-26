<?php 
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 12.09.2022
    Description: Exercices Model calling Model Class 
*/

namespace App\Models;


require_once(SOURCE_DIR.'/models/model.php');
use App\Models\Model as Model;

class Exercise extends Model
{
    private const TABLE = 'exercises';
    protected $id; 
    protected $title;
    protected $state;

    public function __construct($id, $title, $state) {
        $this->id = $id;
        $this->title = $title;
        $this->state = $state;
    }
    public function getID() 
    {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
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

    public function sync() {
        $this->update(
            self::TABLE,
            ['title', 'state'],
            [$this->title,$this->state],
            $this->id
        );
    }

    public static function getExercises($where = "")
    {
        $result = [];
        $data = self::select("exercises", "*", $where);
        foreach($data as $exercise) {
            array_push(
                $result,
                new self(
                    $exercise['id'],
                    $exercise['title'],
                    $exercise['state']
                )
            );
        }
        return $result;
    }

    public static function create($title, $state = "Building")
    {
        $id = self::insert(self::TABLE, 'title,state', "$title,$state");
        return new self($id, $title, $state);
    }
}