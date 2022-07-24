<?php

namespace olawuyi\country_code\models;



//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//require '../../vendor/autoload.php';




require '../../helpers/Paginate.php';
require '../../helpers/Search.php';

use \olawuyi\country_code\helpers\Paginate;
use olawuyi\country_code\helpers\Search;

class CountryCode {

    private $conn ;
    private $table = 'country_codes';

    //Country Properties

    public $id;
    public $continent_code;
    public $currency_code;
    public $iso2_code;
    public $iso3_code;
    public $iso_numeric_code;
    public $fips_code;
    public $calling_code;
    public $common_name;
    public $official_name;
    public $endonym;
    public $demonym;


    public function __construct($db)
    {
        $this->conn = $db;
    }





    public function searchData($dataLookUp)
    {
        $searchData  = new Search($this->conn ,'country_data');
        $data =   $searchData->search($dataLookUp);
        return $data;
    }



    public function import($data)
    {

        $file = fopen($data , 'r');
        while($row = fgetcsv($file))
        {
           $value ="'". implode("','" , $row) . "'";
           $query =  "INSERT INTO country_data (
                          continent_code ,currency_code,
                          iso2_code,iso3_code,iso_numeric_code
                          ,fips_code,calling_code,common_name,
                          official_name,endonym,demonym)
                        VALUES (" . $value . ")";
            $stmt  = $this->conn->prepare($query);
//            $stmt->execute();

        }
        return $stmt;

    }

}
