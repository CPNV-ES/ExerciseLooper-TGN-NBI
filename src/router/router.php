<?php
namespace App\Router;

require('./src/router/route.php');
use App\Router\Route as Route;


class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url) {
        $this->url = $url;
    }

    public function get($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method) {
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

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            include('./src/views/errors/404.html');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->match($this->url)) {
                return $route->call();
            }
        }
        include('./src/views/errors/404.html');
    }

    public function url($name, $params = []) {
        if(!isset($this->namedRoutes[$name])) {
            include('./src/views/errors/404.html');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

}