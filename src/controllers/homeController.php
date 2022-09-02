<?php

namespace App\Controllers;
use App\Services\Templating;

class HomeController 
{
    static function index() {
        Templating::generate('./src/views/template.php', './src/views/home/index.php');
    }
}