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

class FulfillmentController extends Controller
{
    public function new($id)
    {
        $exercise = Exercise::getOne($id);
        if ($exercise) {
            $this->render('template.php', 'fulfillments/new.php',[
                "exercise" => $exercise
            ]);
            return;
        }
        $this->render('template.php', 'errors/404.html');
    }
}
