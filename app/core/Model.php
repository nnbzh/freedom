<?php

namespace app\core;

use application\lib\DB;
use QueryBuilder;

abstract class Model
{
    protected $table = '';
    protected $fields = [];
    protected $db;
    protected $queryBuilder;

    public function __construct()
    {
        $this->db = new DB();
        $this->queryBuilder = new QueryBuilder();
    }

    public function query(string $query) {
        return $this->db->query($query);
    }

    protected function setTable($table) {
        $this->table = $table;
    }

    protected function getTable(): string
    {
        return $this->table;
    }

    protected function filterParams($params): array
    {
        $new = [];
        foreach ($this->fields as $field) {
            if (isset($params[$field])) $new[$field] = $params[$field];
        }

        return $new;
    }
}