<?php
namespace ExerciseLooper\Controllers;

class HomeController {
    static function home() {
        include('./src/views/home.php');
    }
    static function foo() {
        include('./src/views/foo.php');
    }
}