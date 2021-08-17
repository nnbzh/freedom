<?php

namespace app\core;

class Router
{
    private $routes;

    public function add($method, $uri, $controller) {
        $this->routes["$uri/$method"] = $controller;
    }

    public function run() {
        $needle = $this->parse($this->requestUriWithMethod());

        if (! empty($needle))  {
            $controller = $needle[0];
            $method = $needle[1];
            $class = CONTROLLERS_FOLDER.$controller;

            if (class_exists($class)) {
                if (method_exists($class, $method)) {
                    $controller = new $class($_REQUEST);
                    $controller->$method();
                }
                else View::error(404);
            }
            else View::error(404);
        }
        else View::error(404);
    }

    public function parse($action): array
    {
        if (isset($this->routes[$action])) {
            return explode('@', $this->routes[$action]);
        }

        return [];
    }

    public function requestUriWithMethod(): string
    {
        return strtok($_SERVER['REQUEST_URI'], '?').'/'.$_SERVER['REQUEST_METHOD'];
    }
}