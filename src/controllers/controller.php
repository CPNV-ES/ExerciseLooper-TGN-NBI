<?php
namespace App\Controller;
use App\Router\Router as Router;
use App\Renderer\Renderer as Renderer;
class Controller {
    
    protected $router;

    public function __construct() 
    {
        $this->router = Router::getInstance($_SERVER['REQUEST_URI']);
    }

    public function render($template, $content, $data = []) 
    {
        return Renderer::render($template, $content, $data);
    }

    public function redirect($route, $params=[]) 
    {
        if (strpos($route, "/")) {
            header('Location:' . $route);
        } else {
            $namedRoute = $this->router->url($route, $params);
            header('Location:/'.$namedRoute);
        }
    }

}