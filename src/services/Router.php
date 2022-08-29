<?php
namespace ExerciseLooper\Services;
include('../controllers/homeController.php');
use ExerciseLooper\Controllers\HomeController as HomeController;
class Router 
{
    private $path = [];
    private $params;

    function __construct() 
    {
        $this->params = $_SERVER['REQUEST_URI'];
    }

    function get($url, $view) 
    {
        $method = $_SERVER['REQUEST_METHOD'];
        array_push($this->path, [$url, $view, $method]);
    }
    
    function verify() 
    {
        $fileFound = false;
        for($i = 0; $i < count($this->path); $i++) {
            if($this->path[$i][0] === $this->params) {
                $this->path[$i][1]();
                $fileFound = true;
            }
        }
        if(!$fileFound) {
            $filePath = __DIR__."/../views/errors/404.html";
            include($filePath);
        }
    }
}