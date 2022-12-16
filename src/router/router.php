<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Router of website
*/

namespace Src\Router;

use Src\Router\Route;
use Src\Renderer\Renderer;

class Router
{
    private static $instance;
    private $url;
    private $routes = [];
    private $namedRoutes = [];

    /**
     * Private constructor to prevent direct instantiation.
     *
     * @param string $url URL of the current request
     */
    private function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Method to add a GET route.
     *
     * @param string $path Path for the route
     * @param callable $callable Callable to be called when the route is matched
     * @param string|null $name Name for the route (optional)
     * @return Route The added Route object
     */
    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * Method to add a POST route.
     *
     * @param string $path Path for the route
     * @param callable $callable Callable to be called when the route is matched
     * @param string|null $name Name for the route (optional)
     * @return Route The added Route object
     */
    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * Method to add a route with a specific HTTP method.
     *
     * @param string $path Path for the route
     * @param callable $callable Callable to be called when the route is matched
     * @param string|null $name Name for the route (optional)
     * @param string $method HTTP method for the route
     * @return Route The added Route object
     */
    private function add($path, $callable, $name, $method)
    {
        // create a new Route object
        $route = new Route($path, $callable);
        // add the Route to the list of routes for the specified HTTP method
        $this->routes[$method][] = $route;
        // if the callable is a string and no name was provided, use the callable as the name
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        // if a name was provided, add the Route to the list of named routes
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        // return the Route object
        return $route;
    }

    /**
     * Method to run the Router.
     */
    public function run()
    {
        // check if there are any routes for the current HTTP method
        if (isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            // loop through the routes for the current HTTP method
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                // if the route matches the current URL, call the route's callable
                if ($route->match($this->url)) {
                    return $route->call();
                }
            }
        }
        // if no matching route was found, render the 404 error page
        Renderer::render('template.php', 'errors/404.html');
    }

    /**
     * Method to get the URL for a named route.
     *
     * @param string $name Name of the route
     * @param array $params Parameters for the route (optional)
     * @return string|null The URL for the named route, or null if the route does not exist
     */
    public function getUrl($name, $params = [])
    {
        // if the named route does not exist, return null
        if (!isset($this->namedRoutes[$name])) {
            return null;
        }
        // get the URL for the named route and return it
        return $this->namedRoutes[$name]->getUrl($params);
    }

    /**
     * Method to get the singleton instance of Router.
     *
     * @param string $url URL of the current request
     * @return Router The singleton instance of Router
     */
    public static function getInstance($url)
    {
        if (!self::$instance) {
            self::$instance = new Router($url);
        }
        return self::$instance;
    }
}
