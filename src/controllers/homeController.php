<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Home controller
*/
namespace App\Controllers;
use App\Controller\Controller;

class HomeController extends Controller
{
    public function index() {
        $this->render('homeTemplate.php', 'home/index.php');
    }
}