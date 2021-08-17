<?php

use app\core\Router;

require './app/bootstrap.php';

$env = new \Dotenv\Dotenv(__DIR__);
$env->load();

$router = new Router();

$router->add('GET', '/', 'TasksController@list');
$router->add('POST', '/', 'TasksController@create');

$router->run();