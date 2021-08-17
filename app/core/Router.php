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
        debug($needle);
    }

    public function parse($action): array
    {
        return explode('@', $this->routes[$action]);
    }

    public function requestUriWithMethod(): string
    {
        return $_SERVER['REQUEST_URI'].'/'.$_SERVER['REQUEST_METHOD'];
    }
}