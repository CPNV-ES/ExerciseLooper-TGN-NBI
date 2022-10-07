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

    public function delete($id) {
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
            "router" => $this->router,
        ]);
    }

    public function manage()
    {
        $exercisesBuilding = Exercise::getAll(["state" => 'Building']);
        $exercisesAnswering = Exercise::getAll(["state" => 'Answering']);
        $exercisesClosed = Exercise::getAll(["state" => 'Closed']);
        $this->render('template.php', 'exercise/manage.php', [
            "router" => $this->router,
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
}
