<?php

namespace app\controllers;

use app\core\View;
use Task;

class TasksController
{
    private $model;
    private $view;
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
        $this->model = new Task();
        $this->view = new View();
    }

    public function list() {
        $this->view->render('tasks', $this->model->all(["tasks" => $this->params]));
    }

    public function create() {
        $result = $this->model->create($this->params);
    }

}