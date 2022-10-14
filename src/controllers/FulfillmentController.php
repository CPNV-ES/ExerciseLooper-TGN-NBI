<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Thomas Grossmann
    Date: 30.09.2022
    Description: Controller of fields.
*/

namespace Src\Controllers;

use Src\Controllers\Controller;
use Src\Models\Field;
use Src\Models\Exercise;
use Src\Models\Fulfillment;

class FulfillmentController extends Controller
{
    public function new($exerciseId)
    {
        $exercise = Exercise::getOne($exerciseId);
        if ($exercise) {
            $this->render('template.php', 'fulfillments/new.php',[
                "exercise" => $exercise,
                "formNewFulfillmentURL" => $this->router->getUrl('newFulfillmentPost', ['id' => $exerciseId])
            ]);
            return;
        }
        $this->render('template.php', 'errors/404.html');
    }

    public function newPost($exerciseId) 
    {
        $fulfillmentsPost = $_POST['fulfillment']['answers_attributes'];
        $newFulfillment = Fulfillment::create(date("Y-m-d h:m:s"), $exerciseId, $fulfillmentsPost);
        $this->redirect('editFulfillment', ['id' => $exerciseId, 'fulfillment' => $newFulfillment->getId()]);
    }

    public function edit($exerciseId, $fulfillmentId) 
    {
        $fulfillment = Fulfillment::getOne($fulfillmentId);
        $exercise = Exercise::getOne($exerciseId);
       if ($exercise && $fulfillment) {
            $this->render('template.php', 'fulfillments/new.php',[
                "exercise" => $exercise,
                "formNewFulfillmentURL" => $this->router->getUrl('editFulfillmentPost', ['id' => $exerciseId, 'fulfillment' => $fulfillmentId])
            ]);
            return;
        }
        $this->render('template.php', 'errors/404.html');
    }

    public function results($exerciseId, $fulfillmentId)
    {
        $fulfillment = Fulfillment::getOne($fulfillmentId);
        $fields = Field::getAll(["exercises_id" => $exerciseId]);
        $exercise = Exercise::getOne($exerciseId);
        $this->render('template.php', 'fulfillments/results.php', [
            "router" => $this->router,
            "headerColor" => "results",
            "headerTitle" => "Exercise: <a href=''>" . $exercise->getTitle() . "</a>",
            "fulfillment" => $fulfillment,
            "fields" => $fields
        ]);
    }
}
