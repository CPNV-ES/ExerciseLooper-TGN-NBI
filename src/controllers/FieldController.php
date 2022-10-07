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
class FieldController extends Controller
{
    public function new($id)
    {
        $formNewFieldURL = $this->router->getUrl("newField", ["id" => $id]);
        $exercise = Exercise::getOne($id);
        if ($exercise) {
            $fields = $exercise->getFields();
            $this->render('template.php', 'fields/new.php', [
                "headerColor" => "managing",
                "headerTitle" => "Exercise : <span class='bold'>" . $exercise->getTitle() . "</span>",
                "formNewFieldURL" => $formNewFieldURL,
                "exerciseId" => $id,
                "fields" => $fields,
            ]);
            return;
        }
        $this->render('template.php', 'errors/404.html');
    }

    public function newPost()
    {
        $field = $_POST['field'];
        $exerciseId = $field['exerciseId'];
        $newField = Field::create($field['title'],$field['field'], $exerciseId);
        $this->redirect('newField', ["id" => $exerciseId]);
    }

}
