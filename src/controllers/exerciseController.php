<?php

namespace App\Controllers;

use App\Services\Templating;

class ExerciseController
{
    static function new()
    {
        Templating::generate('./src/views/template.php', './src/views/exercise/new.php');
    }
}