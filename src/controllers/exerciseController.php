<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Controller of exercices.
*/
namespace App\Controllers;
use App\Controller\Controller;

class ExerciseController extends Controller
{
    public function new()
    {
        $this->render('template.php', 'exercise/new.php',[
            "headerColor" => "managing",
            "headerTitle" => "New exercise",
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