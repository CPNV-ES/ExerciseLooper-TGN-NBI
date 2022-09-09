<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Home controller
*/
namespace App\Controllers;
use App\Services\Templating;

class HomeController 
{
    public static function index() {
        Templating::render('homeTemplate.php', 'home/index.php');
    }
}