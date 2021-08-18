<?php

namespace app\controllers;

use Admin;
use app\core\Controller;
use app\core\View;

class AdminController
{
    protected $model;
    private $view;
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
        $this->model = new Admin();
        $this->view = new View();
    }

    public function index() {
        $this->view->render('login');
    }

    public function login() {
        $user = $this->model->login($this->params);
        if (! is_null($user)) {
            $_SESSION['is_authorized'] = true;
            $_SESSION['user'] = $user['login'];
        }
        $this->view->redirect();
    }
}