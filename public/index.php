<?php
namespace App;

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');

require(SOURCE_DIR.'/router/router.php');
use App\Router\Router as Router;

require(SOURCE_DIR.'/controllers/homeController.php');
require(SOURCE_DIR.'/services/templating.php');
require(SOURCE_DIR.'/controllers/exerciseController.php');

$router = new Router($_SERVER['REQUEST_URI']);

$router->get('/', "home#index");

$router->get('/exercises/new', "exercise#new");

$router->run();