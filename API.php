<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require 'core/config.php';
require 'core/Controller.php';

$JSON = file_get_contents('php://input');
$DATA = json_decode($JSON, true);
$METHOD = $_SERVER['REQUEST_METHOD'];

if ($METHOD === 'GET') {

    if (isset($DATA['ACTION']) && $DATA['ACTION'] == 'LOGIN') {
        __LOGIN($DATA, $conn);
    }

}

if ($METHOD == 'POST') {
    if (isset($DATA['ACTION']) && $DATA['ACTION'] == 'REGISTER') {
        __REGISTER($DATA, $conn);
    }
}

?>