<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/utils/debugger.php';

session_start();

const CONTROLLERS_FOLDER = "app\\controllers\\";
const ERRORS_FOLDER = "app/views/errors/";