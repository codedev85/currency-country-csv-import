<?php
namespace olawuyi\country_code\models;

//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//require '../../vendor/autoload.php';
//include_once '../helpers/Paginate.php';

use olawuyi\country_code\helpers\Paginate;
use olawuyi\country_code\helpers\Search;

require '../../helpers/Search.php';

class CurrencyCode {

    private $conn ;
    private $table = 'country_codes';

    //Country Properties

    public $id;
    public $iso_code;
    public $iso_numeric_code;
    public $common_name;
    public $official_name;
    public $symbol;



    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function read()
    {
//        $query = "SELECT * FROM currency_data ";
//        $stmt  = $this->conn->prepare($query);
//        $stmt->execute();
//        return $stmt;

        $pagination  = new Paginate($this->conn ,'currency_data');
        $data = $pagination->get_data();
        $pages  = $pagination->get_pagination_number();
        return $data;

    }

    public function searchData($dataLookUp)
    {
        $searchData  = new Search($this->conn ,'currency_data');
        $data =   $searchData->search($dataLookUp);
        return $data;
    }




    public function import($data)
    {
        $file = fopen($data , 'r');
        while($row = fgetcsv($file))
        {
            $value ="'". implode("','" , $row) . "'";
            $query =  "INSERT INTO currency_data ( iso_code ,iso_numeric_code,common_name, official_name ,symbol) VALUES (" . $value . ")";
            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
        }
        return $stmt;

    }

}
