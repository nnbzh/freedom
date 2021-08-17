<?php

namespace application\lib;
use PDO;
use PDOException;

class DB
{
    public $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                "pgsql:" .
                "host=".getenv('DB_HOST') .";".
                "dbname=".getenv('DB_NAME'),
                getenv('DB_USER'),
                getenv('DB_PASSWORD')
            );
        } catch (PDOException $e) {
            debug($e->getMessage());
        }
    }

    public function query($stmt) {
        $a = $this->db->prepare($stmt);
        $a->execute();

        return $a->fetchAll(PDO::FETCH_ASSOC);
    }
}