<?php

namespace olawuyi\country_code\helpers;

use PDO;
use stdClass;

class Paginate {

    private $db;
    private $table;
    private $total_records;
    private $limit = 10;
    //PDO connection

    public function __construct($db , $table)
    {
        $this->db = $db;
        $this->table = $table;
    }


    public function set_total_records(){
        $stmt   = $this->db->prepare("SELECT *  FROM $this->table");
        $stmt->execute();
        $this->total_records = $stmt->rowCount();
    }


    public function current_page(){
        return isset($_GET['page']) ? (int)$_GET['page'] :1;
    }

    public function get_data(){
        $start = 0;
        if($this->current_page() > 1){
            $start = ($this->current_page() * $this->limit) - $this->limit;
        }
        $stmt = $this->db->prepare("SELECT * FROM $this->table LIMIT $start, $this->limit");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_pagination_number(){
        return ceil($this->total_records / $this->limit);
    }

}