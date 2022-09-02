<?php
namespace App;

require('./src/router/Router.php');
use App\Router\Router as Router;

require('./src/controllers/HomeController.php');
use App\Controllers\HomeController as HomeController;

$router = new Router($_SERVER['REQUEST_URI']);

$router->get('/', "home#home");

$router->get('/contact/:id', "home#homeView");

$router->run();