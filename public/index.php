<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Index of the website.
*/

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');

require(BASE_DIR."/vendor/autoload.php");
use Src\Router\Router;

$router = Router::getInstance($_SERVER['REQUEST_URI']);

//Home routes
$router->get('/', "home#index", "home");

//Exercises routes
$router->get('/exercises/new', "exercise#new", "newExercise");
$router->post('/exercises/new', "exercise#newPost", "newExercisePost");
$router->post('/exercises/:id/delete', "exercise#delete", "deleteExercise");

$router->get('/exercises/answering', "exercise#answering");

$router->get('/exercises', "exercise#manage", "manage");

$router->get('/exercises/:id/fields', "field#new", "newField");
$router->post('/exercises/:id/fields', "field#newPost", "newFieldPost");

$router->run();
