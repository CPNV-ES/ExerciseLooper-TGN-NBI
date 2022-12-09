<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Controller of exercices.
*/

namespace Src\Controllers;

use Src\Controllers\Controller;
use Src\Models\Exercise;
use Src\Models\Fulfillment;
use Src\Models\Field;

class ExerciseController extends Controller
{
    public function new()
    {
        $formNewExerciseURL = $this->router->getUrl("newExercisePost");
        $this->render('template.php', 'exercise/new.php', [
            "headerColor" => "managing",
            "headerTitle" => "New exercise",
            "formNewExerciseURL" => $formNewExerciseURL,
        ]);
    }

    public function delete($id) 
    {
        $exercise = Exercise::getOne($id);
        $exercise->destroy();
        $this->redirect('manage');
    }

    public function updateState($id, $state)
    {
        $exercise = Exercise::getOne($id);
        if ($state == "Answering" || $state == "Closed") {
            $exercise->setState($state);
            $exercise->sync();
        }
        $this->redirect('manage');
    }

    public function answering()
    {
        $exercises = Exercise::getAll(["state" => 'Answering']);
        $this->render('template.php', 'exercise/answering.php', [
            "headerColor" => "answering",
            "exercises" => $exercises,
        ]);
    }

    public function manage()
    {
        $exercisesBuilding = Exercise::getAll(["state" => 'Building']);
        $exercisesAnswering = Exercise::getAll(["state" => 'Answering']);
        $exercisesClosed = Exercise::getAll(["state" => 'Closed']);
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
        $this->redirect('newField', ["id" => $newExercise->getID()]);
    }

    public function results($id)
    {
        $fulfillments = Fulfillment::getAll(["exercises_id" => $id]);
        $fields = Field::getAll(["exercises_id" => $id]);
        $exercise = Exercise::getOne($id);
        $this->render('template.php', 'exercise/results.php', [
            "headerColor" => "results",
            "headerTitle" => [
                "beforeLink" => "Exercise: ",
                "link" => "",
                "afterLink" => $exercise->getTitle() ,
            ],
            "fulfillments" => $fulfillments,
            "fields" => $fields,
            "exerciseId" => $exercise->getID()
        ]);
    }
}
