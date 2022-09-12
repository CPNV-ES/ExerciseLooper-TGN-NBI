<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Controller of exercices.
*/
namespace App\Controllers;
use App\Controller\Controller;
use App\Renderer\Renderer;
require_once(SOURCE_DIR . "/models/exercisesModel.php");
use App\Models\ExercisesModel as ExerciseModel;

class ExerciseController extends Controller
{
    public function new()
    {
        $exerciseModel = new ExerciseModel();
        $data = $exerciseModel->read();
        $this->render('template.php', 'exercise/new.php',[
            "headerColor" => "managing",
            "headerTitle" => "New exercise",
            "exercises" => $data,
        ]);
    }

    public function newPost()
    {
        $exercise = $_POST['exercise'];

        $this->render('template.php', 'exercise/new.php',[
            "headerColor" => "managing",
            "headerTitle" => "New exercise",
        ]);
    }
}