<?php

namespace olawuyi\country_code\helpers;

use Exception;
use PDO;
use PDOException;
use stdClass;

class Search {

    private $db;
    private $table;


    //PDO connection

    public function __construct($db , $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function search($title)
    {
        try{
            $q = "SELECT * FROM $this->table WHERE official_name LIKE ?";
            $stmt = $this->db->prepare($q);
            $stmt->execute(array("%$title%"));
        }catch(PDOException $e){
            echo "ERROR:". $e->getMessage();
        }
        if(!$stmt->rowCount()){
            return false; #this will return false if data isn't found.
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



}