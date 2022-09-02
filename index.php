<?php
namespace App;

require('./src/router/router.php');
use App\Router\Router as Router;

require('./src/controllers/homeController.php');
require("./src/services/templating.php");
require('./src/controllers/exerciseController.php');

$router = new Router($_SERVER['REQUEST_URI']);

$router->get('/', "home#index");

$router->get('/exercises/new', "exercise#new");

$router->run();