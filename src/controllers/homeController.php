<?php

namespace App\Controllers;

class HomeController {
    static function index() {
       include('./src/views/home.php');
    }
}