<?php

namespace app\core;

class View
{
    public function render($location, $vars = []) {
        debug($vars);
        extract($vars);
        if (file_exists('app/views/'.$location.'.php')) {
            ob_start();
            require 'app/views/'.$location.'.php';
            $output = ob_get_contents();
            ob_end_flush();
            return $output;
        }

        View::error(404);
    }

    public static function error($code) {
        http_response_code($code);
        require_once ERRORS_FOLDER."$code.php";
        exit;
    }
}