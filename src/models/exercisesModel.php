<?php 
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 09.09.2022
    Description: PDO Instanciation and model functions related to Exercises
*/

namespace App\Models;

require_once(SOURCE_DIR.'/models/model.php');
use App\Models\Model as Model;

class ExercisesModel extends Model
{
    public function getAll()
    {
        return $this->select("exercises", "*");
    }

    /*public function create()
    {
        return $this->insert();
    }*/
}