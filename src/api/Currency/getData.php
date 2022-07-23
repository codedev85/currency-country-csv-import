<?php
namespace olawuyi\country_code\Country;
//headers
use olawuyi\country_code\config\Database;
use olawuyi\country_code\models\CurrencyCode;
use PDO;

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');

include_once '../../config/Database.php';
include_once '../../models/CurrencyCode.php';

$database = new Database();
$db = $database->connect();

$currencyCode = new CurrencyCode($db);
$result = $currencyCode->read();
$num = $result->rowCount();

if($num > 0 ) {
    $currencyArr = Array();
    $currencyArr['data'] = Array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $currency_item = array(
            'id' => $id,
            'iso_code' => $iso_code,
            'iso_numeric_code' => $iso_numeric_code,
            'common_name' => $common_name,
            'official_name' =>  $official_name,
            'symbol' =>  $symbol,
        );
        array_push($currencyArr['data'],$currency_item);
    }

    echo json_encode($currencyArr);
}else{

    echo json_encode(
        array('message' => 'No Country Found')
    );
}
