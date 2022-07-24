<?php
namespace olawuyi\country_code\Country;
//headers
use olawuyi\country_code\config\Database;
use olawuyi\country_code\models\CountryCode;
use PDO;

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');

include_once '../../config/Database.php';
include_once '../../models/CountryCode.php';

$database = new Database();
$db = $database->connect();

$countryCode = new CountryCode($db);
$result = $countryCode->read();
//$num = $result->rowCount();
$num = count($result);

if($num > 0 ) {

    echo  json_encode($result);
//    $countryArr = Array();
//    $countryArr['data'] = Array();
//
//    while($row = $result->fetch(PDO::FETCH_ASSOC)){
//        extract($row);
//
//        $country_item = array(
//            'id' => $id,
//            'continent_code' => $continent_code,
//            'currency_code' =>  $currency_code,
//            'iso2_code' => $iso2_code,
//            'iso3_code' =>  $iso3_code,
//            'iso_numeric_code' =>  $iso_numeric_code,
//            'fips_code' => $fips_code,
//            'calling_code' =>  $calling_code,
//            'common_name' => $common_name,
//            'official_name' =>  $official_name,
//            'endonym' =>  $endonym,
//            'demonym' => $demonym
//        );
//        array_push($countryArr['data'],$country_item);
//    }
//
//    echo json_encode($countryArr);
}else{

    echo json_encode(
        array('message' => 'No Country Found')
    );
}
