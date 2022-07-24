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
$result = $countryCode-> searchData($_POST['search_data']);
//$num = $result->rowCount();

$num = !empty($result) ? count($result) : 0 ;

if($num > 0 ) {
    echo  json_encode($result);
}else{

    echo json_encode(
        array('message' => 'No Country Found')
    );
}
