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
    public function newPost($exerciseId) {
        $fulfillmentsPost = $_POST['fulfillment']['answers_attributes'];
        Fulfillment::create(date("Y-m-d h:m:s"), $exerciseId, $fulfillmentsPost);
        $this->redirect('newFulfillment', ['id' => $exerciseId]);
    }
}
