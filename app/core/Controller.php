<?php

namespace app\core;

abstract class Controller
{
    protected $model;

    function setModel(Model $model) {
        $this->model = $model;
    }
}