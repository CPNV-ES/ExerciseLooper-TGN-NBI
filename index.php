<?php
namespace ExerciseLooper;

include('./src/services/Router.php');
use ExerciseLooper\services\Router as Router;

$router = new Router();

$router->get("/", ['HomeController', 'home']);
$router->get("/", ['HomeController', 'foo']);

$router->verify();