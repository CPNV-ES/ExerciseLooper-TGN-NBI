<?php
namespace App\Services;
class Templating 
{
    public static function generate($template, $content, $data = []) {
        ob_start();
        include($content);
        $content = ob_get_clean();
        include($template);
    } 
}