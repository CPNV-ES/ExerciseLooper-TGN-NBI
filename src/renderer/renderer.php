<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Class for use template
*/

namespace Src\Renderer;

class Renderer
{
    public static function render($template, $content, $data = [])
    {
        if ($template) {
            ob_start();
            include(SOURCE_DIR . "/views/$content");
            $content = ob_get_clean();
            include(SOURCE_DIR . "/views/templates/$template");
        } else {
            include(SOURCE_DIR . "/views/$content");
        }
    }
}
