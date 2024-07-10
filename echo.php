<?php
header('Access-Control-Allow-Origin: *');

$header_list = array($_SERVER["HTTP_X_UP_CALLING_LINE_ID"], $_SERVER["HTTP_X_NOKIA_MSISDN"], $_SERVER["HTTP_MSISDN"]);
$header_list = array_trim($header_list);

$output = array();

if (count($header_list) === 0) {

    $output = array('msisdn' => false, 'network' => false);

} else {

    $msisdn  = $header_list[0];          //get number
    $network = get_mno_updated($msisdn); //get network

    $output = array('msisdn' => $msisdn, 'network' => $network);

}

header('Content-Type: application/json');
// echo json_encode($output);
$headers = $_SERVER;
echo json_encode($headers);

//functions
//trim array
function array_trim($array)
{
    while (!empty($array) and strlen(reset($array)) === 0) {
        array_shift($array);
    }
    while (!empty($array) and strlen(end($array)) === 0) {
        array_pop($array);
    }
    return $array;
}
