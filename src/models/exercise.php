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

define('TABLE', 'exercises');

class Exercise extends Model
{
    public function getAll()
    {
        return $this->select("exercises", "*");
    }

    public function create($fields, $values)
    {
        return $this->insert(TABLE, $fields, $values);
    }
}