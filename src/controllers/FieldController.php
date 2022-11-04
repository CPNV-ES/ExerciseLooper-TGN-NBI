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
                "headerTitle" => [
                    "beforeLink" => "Exercise: ",
                    "link" => "",
                    "afterLink" => $exercise->getTitle() ,
                ],
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
        Field::create($field['title'],$field['field'], $exerciseId);
        $this->redirect('newField', ["id" => $exerciseId]);
    }

    public function delete($exerciseId, $fieldId)
    {
        $field = Field::getOne($fieldId);
        $field->destroy();
        $this->redirect('newField', ['id' => $exerciseId]);
    }

    public function edit($exerciseId, $fieldId)
    {
        $exercise = Exercise::getOne($exerciseId);
        $field = Field::getOne($fieldId);
        if($exercise && $field) {
            $this->render('template.php', 'fields/edit.php', [
                "headerColor" => "managing",
                "headerTitle" => [
                    "beforeLink" => "Exercise: ",
                    "link" => "",
                    "afterLink" => $exercise->getTitle() ,
                ],
                "field" => $field,
                "exerciseId" => $exerciseId,
            ]);
            return;
        }
        $this->render('template.php', 'errors/404.html');
    }

    public function editPost($exerciseId, $fieldId)
    {
        $field = Field::getOne($fieldId);
        $newField = $_POST['field'];
        $field->setField($newField['value_kind']);
        $field->setTitle($newField['title']);
        $field->sync();
        $this->redirect('newField', ['id' => $exerciseId]);
    }
}
