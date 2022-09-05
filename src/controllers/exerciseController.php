<?php

namespace App\Controllers;

use App\Services\Templating;

class ExerciseController
{
    public static function new()
    {
        Templating::render('template.php', 'exercise/new.php',[
            "headerColor" => "managing",
            "headerTitle" => "New exercise",
        ]);
    }
}