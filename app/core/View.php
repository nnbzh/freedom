<?php

namespace app\core;

class View
{
    public function render($view, $vars = []) {
        if (file_exists('app/views/'.$view.'.php')) {
            ob_start();
            extract($vars);
            require 'app/views/'.$view.'.php';
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

    public function redirect($url = '') {
        header('Location: /'.$url);
        exit;
    }
}