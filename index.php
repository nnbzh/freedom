<?php

use App\core\Router;

require './app/bootstrap.php';

$env = new \Dotenv\Dotenv(__DIR__);
$env->load();

$router = new Router();

$router->add('GET', '/tasks', 'TasksController@list');

$router->run();