<?php

use app\core\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fields = ['login', 'password'];

    public function __construct()
    {
        parent::__construct();
        $this->queryBuilder->setTable($this->table);
    }

    public function login($params) {
        return $this->db->query(
                ($this->queryBuilder
                    ->where('login', '=', "'".$params['login']."'")
                    ->where('password', '=', "'".$params['password']."'")
                    ->get()
                )
            )[0] ?? null;
    }

    public function create($params) {
        $params = $this->filterParams($params);
        return $this->db->query($this->queryBuilder->create(array_keys($params), array_values($params)));
    }

    public function count() {
        return $this->db->query($this->queryBuilder->count())[0];
    }

}