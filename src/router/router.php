<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Router of website
*/
namespace App\Router;

require(SOURCE_DIR.'/router/route.php');
use App\Router\Route as Route;
use App\Renderer\Renderer;

class Router 
{

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url) 
    {
        $this->url = $url;
    }

    public function get($path, $callable, $name = null) 
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null) 
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method) 
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null){
            $name = $callable;
        }
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run()
    {
        if(isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                if($route->match($this->url)) {
                    return $route->call();
                }
            }
        }
        Renderer::render('template.php', 'errors/404.html');
    }

    public function url($name, $params = []) 
    {
        if(!isset($this->namedRoutes[$name])) {
            Renderer::render('template.php', 'errors/404.html');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
}