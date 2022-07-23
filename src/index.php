<?php

namespace olawuyi\country_code;

use olawuyi\country_code\config\Database;
use olawuyi\country_code\models\CountryCode;
use PDO;

require '../vendor/autoload.php';
include_once 'config/Database.php';
include_once 'models/CountryCode.php';

$conn = new Database();
$db =$conn->connect();

//read data
$readCountryCodes = new CountryCode($db);
$data = $readCountryCodes->read();
$num = $data->rowCount();

if($num > 0 ) {
    $countryArr = Array();
    $countryArr['data'] = Array();
    while($row = $data->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $country_item = array(
            'id' => $id,
            'continent_code' =>  $continent_code,
            'currency_code' =>  $currency_code,
            'iso2_code' => $iso2_code,
            'iso3_code' =>  $iso3_code,
            'iso_numeric_code'=>  $iso_numeric_code,
            'fips_code' => $fips_code,
            'calling_code' => $calling_code,
            'common_name'=>  $common_name,
            'official_name'=>  $official_name,
            'endonym' =>  $endonym,
            'demonym' =>  $demonym,
        );
        array_push($countryArr['data'],$country_item);
    }

//    echo json_encode($countryArr);
}else{

    echo json_encode(
        array('message' => 'No Country Found')
    );
}
//ends here


//add data

$importCountryCodes = new CountryCode($db);
if(isset($_POST['import']))
{
    $importCountryCodes->import($_FILES['file']['tmp_name']);
}

//$data = $importCountryCodes->import('Somalia');
//$num = $data->rowCount();
//
//if($num > 0 ) {
//    $countryArr = Array();
//    $countryArr['data'] = Array();
//    while($row = $data->fetch(PDO::FETCH_ASSOC)){
//        extract($row);
//        $country_item = array(
//            'id' => $id,
//            'countryName' =>  $country_name
//        );
//        array_push($countryArr['data'],$country_item);
//    }
//
//    echo json_encode($countryArr);
//}else{
//
//    echo json_encode(
//        array('message' => 'No Country Found')
//    );
//}

?>
<style>
    body{
        /* fallback for old browsers */
        background: #6a11cb;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
    .outer-container{
        background: white;
        padding:10px;

        width: 500px;


    }
    .centreDiv{
        display: flex;
        justify-content: center;
    }
</style>
<div class="centreDiv"  >

    <div class="outer-container">
        <h3> Import Country Code</h3>
        <form action="" method="post"
              name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                                        id="file" accept=".xls,.xlsx ,.csv">
                <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
            </div>
        </form>
    </div>
</div>



