<?php

class Router
{
    private $routes = [];

    // Method to add a GET route
    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    // Method to add a POST route
    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    // Method to add a generic route (could be extended for other methods like PUT, DELETE)
    private function addRoute($method, $path, $handler)
    {
        $this->routes[] = ['method' => $method, 'path' => $path, 'handler' => $handler];
    }

    // Method to dispatch the request
    public function dispatch($requestUri, $requestMethod)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                // Call the handler, which can be a function or a controller@method string
                if (is_callable($route['handler'])) {
                    call_user_func($route['handler']);
                } elseif (is_string($route['handler'])) {
                    $this->handleControllerAction($route['handler']);
                }
                return;
            }
        }

        // If no route matches

    }

    // Method to handle controller and action from a string "Controller@action"
    private function handleControllerAction($handler)
    {
        list($controllerName, $action) = explode('@', $handler);
        $controllerFile = "controllers/{$controllerName}.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                echo "Action '$action' not found in controller '$controllerName'.";
            }
        } else {
            echo "Controller '$controllerName' not found.";
        }
    }
}
