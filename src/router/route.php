<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Class for create a new route
*/

namespace Src\Router;

class Route
{
    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    /**
     * Constructor for Route class
     *
     * @param string $path Path of the route
     * @param mixed $callable Callable function to execute when the route is called
     */
    public function __construct($path, $callable)
    {
        // Trim leading and trailing slashes from path
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * Check if the provided URL matches the path of this route
     *
     * @param string $url URL to match against the route's path
     *
     * @return bool True if the URL matches the path, false otherwise
     */
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * Replace a parameter in the route's path with a regular expression
     *
     * @param array $match Array with the parameter to replace as the first element
     *
     * @return string Regular expression for matching the parameter
     */
    private function paramMatch($match)
    {
        if (isset($this->params[$match[1]])) {
            return '(' . $this->params[$match[1]] . ')';
        }

        return '([^/]+)';
    }

    /**
     * Get the URL for this route with the provided parameters
     *
     * @param array $params Array of parameters to substitute in the route's path
     *
     * @return string URL for the route with the provided parameters
     */
    public function getUrl($params)
    {
        $path = $this->path;

        foreach ($params as $key => $value) {
            $path = str_replace(":$key", $value, $path);
        }
        return $path;
    }

    /**
     * Set a custom regular expression for a parameter in the route's path
     *
     * @param string $param Name of the parameter to set the regular expression for
     * @param string $regex Regular expression for matching the parameter
     *
     * @return Route This Route object, for method chaining
     */
    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }
    /**
     * Execute the callable function associated with this route
     *
     * @return mixed Result of the callable function
     */
    public function call()
    {
        // Check if the callable is a string or a function
        if (is_string($this->callable)) {
            $params = explode('#', $this->callable);
            require(SOURCE_DIR . '/controllers/' . $params[0] . 'Controller.php');
            $controller = "Src\\Controllers\\" . $params[0] . "Controller";
            $controller = new $controller();

            return call_user_func_array([$controller, $params[1]], $this->matches);
        } else {

            return call_user_func_array($this->callable, $this->matches);
        }
    }
}
