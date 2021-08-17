<?php

class QueryBuilder
{
    private $table = '';
    private $selected = "*";
    private $orderBy = [];
    private $filter = [];
    private $page = 1;

    public function get(): string
    {
        if (! empty($this->orderBy)) {
            $orders = [];
            foreach ($this->orderBy as $order) {
                $orders[] = $order['column'].' '. $order['direction'];
            }
            $this->orderBy = "ORDER BY ". implode(',', $orders);
        } else $this->orderBy = "";

        if (! empty($this->filter)) {
            $filters = [];
            foreach ($this->filter as $filter) {
                $filters[] = $filter['column'].' '.$filter['operator'].' '. $filter['value'];
            }
            $this->filter = "WHERE ". implode(' AND ', $filters);
        } else $this->filter = "";

        return "SELECT ".$this->selected." FROM ".$this->table." ".$this->filter. " ". $this->orderBy. " " .
            "LIMIT 3 OFFSET ".($this->page - 1) * 3 . ";";
    }

    public function create($columns, $params): string
    {
        $columns = implode(',', $columns);
        $str = '';
        foreach ($params as $key => $value) {
            $str = $str."'$value'";
            if ($key !== sizeof($params) - 1) $str = $str.',';
        }

        return "INSERT INTO ".$this->table."($columns) VALUES ($str)";
    }

    public function setTable($table): QueryBuilder
    {
        $this->table = $table;

        return $this;
    }

    public function select(...$columns): QueryBuilder
    {
        $this->selected = implode(',', $columns);

        return $this;
    }

    public function where($column, $operator, $value): QueryBuilder
    {
        $this->filter[] = [
            "column" => $column,
            "operator" => $operator,
            "value" => $value
        ];

        return $this;
    }

    public function orderBy($column, $direction): QueryBuilder {
        $this->orderBy[] = [
            "column" => $column,
            "direction" => $direction
        ];

        return $this;
    }

    public function page(int $page): QueryBuilder
    {
        $this->page = $page;

        return $this;
    }
}