<?php

use app\core\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fields = ['content', 'email', 'username', 'status'];

    public function __construct()
    {
        parent::__construct();
        $this->queryBuilder->setTable($this->table);
    }

    public function all($params) { 
        if (isset($params['username'])) $this->queryBuilder->orderBy('username', $params['username']);
        if (isset($params['status'])) $this->queryBuilder->orderBy('status', $params['status']);
        if (isset($params['email'])) $this->queryBuilder->orderBy('email', $params['email']);
        if (isset($params['page'])) $this->queryBuilder->page($params['page']);

        return $this->db->query(($this->queryBuilder->get()));
    }

    public function create($params) {
        $params = $this->filterParams($params);
        return $this->db->query($this->queryBuilder->create(array_keys($params), array_values($params)));
    }

    public function count() {
        return $this->db->query($this->queryBuilder->count())[0];
    }

    public function update($id, $params) {
        return $this->db->query($this->queryBuilder->update($id, $params));
    }

}