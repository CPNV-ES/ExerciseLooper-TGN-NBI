<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Index of the website.
*/
namespace App;

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');

require(SOURCE_DIR."/controllers/controller.php");
require(SOURCE_DIR.'/renderer/renderer.php');
require(SOURCE_DIR.'/router/router.php');
use App\Router\Router as Router;

$router = Router::getInstance($_SERVER['REQUEST_URI']);

//Home routes
$router->get('/', "home#index", "home");

//Exercises routes
$router->get('/exercises/new', "exercise#new", "newExercise");
$router->post('/exercises/new',"exercise#newPost", "newExercisePost");

$router->get('/exercises/answering', "exercise#answering");

$router->get('/exercises', "exercise#manage");

$router->run();