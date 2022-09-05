<?php
namespace App\Services;
class Templating 
{
    public static function render($template, $content, $data = []) 
    {
        ob_start();
        include(SOURCE_DIR."/views/$content");
        $content = ob_get_clean();
        include(SOURCE_DIR."/views/templates/$template");
    } 
}