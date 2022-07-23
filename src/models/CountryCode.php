<?php
namespace olawuyi\country_code\models;

//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//require '../../vendor/autoload.php';

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


    public function read()
    {
        $query = "SELECT * FROM country_data";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
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
