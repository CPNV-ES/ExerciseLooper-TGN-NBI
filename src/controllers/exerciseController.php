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

require_once(SOURCE_DIR . '/models/exercise.php');

use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function new()
    {
        $formNewExerciseURL = $this->router->url("newExercisePost");
        $this->render('template.php', 'exercise/new.php', [
            "headerColor" => "managing",
            "headerTitle" => "New exercise",
            "formNewExerciseURL" => $formNewExerciseURL,
        ]);
    }

    public function fieldsCreation($id)
    {

        $this->render('template.php', 'exercise/fieldsCreation.php', []);
    }

    public function answering()
    {
        $exercises = Exercise::getAll("WHERE state='Answering'");
        $this->render('template.php', 'exercise/answering.php', [
            "headerColor" => "answering",
            "exercises" => $exercises,
        ]);
    }

    public function manage()
    {
        $exercisesBuilding = Exercise::getAll("WHERE state='Building'");
        $exercisesAnswering = Exercise::getAll("WHERE state='Answering'");
        $exercisesClosed = Exercise::getAll("WHERE state='Closed'");

        $this->render('template.php', 'exercise/manage.php', [
            "headerColor" => "results",
            "exercisesBuilding" => $exercisesBuilding,
            "exercisesAnswering" => $exercisesAnswering,
            "exercisesClosed" => $exercisesClosed,
        ]);
    }

    public function newPost()
    {
        $exercise = $_POST['exercise'];
        $newExercise = Exercise::create($exercise['title']);
        $this->redirect('fieldsCreation', ["id" => $newExercise->getID()]);
    }
}
