<?php

namespace olawuyi\country_code\config;

use PDO;
use PDOException;

class Database
{
    //DB Cred
    private $host     = 'localhost';
    private $db_name  = 'country_codes';
    private $user     = 'root';
    private $password = 'ola12345';
    private $conn;


    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error : ' . $e->getMessage();
        }

        return $this->conn;
    }
}