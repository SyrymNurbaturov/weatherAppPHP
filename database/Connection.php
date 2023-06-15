<?php

namespace database;

class Connection
{
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = pg_connect("host=localhost port=5432 dbname=comment user=postgres password=admin");
        } catch (\Exception $ex){
            echo 'Message: ' .$ex->getMessage();
        }
    }
}