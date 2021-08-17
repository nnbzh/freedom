<?php

require_once __DIR__.'/../vendor/autoload.php';

$env = new \Dotenv\Dotenv(__DIR__.'/../');
$env->load();

require(__DIR__.'/../app/routes/web.php');