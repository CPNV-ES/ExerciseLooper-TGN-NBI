<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Noah Barberini
    Date: 12.09.2022
    Description: Parent of each controller
*/

namespace Src\Controllers;

use Src\Router\Router;
use Src\Renderer\Renderer;

class Controller
{
    protected $router;

    /**
     * Constructor for Controller class
     */
    public function __construct()
    {
        // Get the Router singleton instance and pass in the current request URL
        $this->router = Router::getInstance($_SERVER['REQUEST_URI']);
    }

    /**
     * Render a view with the specified template and content
     *
     * @param string $template Name of the template file to use
     * @param string $content Name of the view file to render
     * @param array $data Array of data to pass to the view
     *
     * @return string Rendered view
     */
    public function render($template, $content, $data = [])
    {
        // Add the Router object to the data array
        $data["router"] = $this->router;
        // Render the view using the specified template and content, and pass in the data array
        return Renderer::render($template, $content, $data);
    }

    /**
     * Redirect to the specified route or URL
     *
     * @param string $route Name of the route to redirect to, or a full URL
     * @param array $params Array of parameters to substitute in the route's path
     */
    public function redirect($route, $params = [])
    {
        // Check if the route is a full URL or just a route name
        if (strpos($route, "/")) {
            // Route is a full URL, redirect to it
            header('Location:' . $route);
        } else {
            // Route is a named route, get the URL for it
            $namedRoute = $this->router->getUrl($route, $params);
            // Redirect to the named route URL
            header('Location:/' . $namedRoute);
        }
    }
}
