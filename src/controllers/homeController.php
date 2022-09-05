<?php

namespace App\Controllers;
use App\Services\Templating;

class HomeController 
{
    public static function index() {
        Templating::render('homeTemplate.php', 'home/index.php');
    }
}