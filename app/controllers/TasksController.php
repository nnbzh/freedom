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
        $this->view->render('tasks', [
            "tasks" => $this->model->all($this->params),
            "total_pages" => (int) ceil($this->model->count()['count']/3)
        ]);
    }

    public function create() {
        $this->model->create($this->params);
        $this->view->render('tasks', [
            "tasks" => $this->model->all([]),
            "total_pages" => (int) ceil($this->model->count()['count']/3)
        ]);
    }

    public function update() {
        $id = $this->params['id'];
        unset($this->params['id']);
        $this->params['status'] = isset($this->params['status']) ? true : false;
        $this->model->update($id, $this->params);
        $this->view->redirect();
    }
}