<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

header('Content-Type: application/json'); // ตั้งค่าให้ส่งข้อมูลกลับเป็น json

require 'core/Controller.php';
require_once 'core/config.php';

$JSON = file_get_contents('php://input');
$DATA = json_decode($JSON, true);
$METHOD = $_SERVER['REQUEST_METHOD'];
$URI = $_SERVER['PATH_INFO'];

if ($METHOD === 'GET') {

   if ($URI == '/v1/user') {
        print(json_encode(['status' => 'OK', 'message' => 'GET_USER']));
   }else {
        print(json_encode(['status' => 'ERROR', 'message' => 'NOT FOUND']));
   }

}
elseif ($METHOD == 'POST') {

    if (($URI == '/v1/login') && ( isset($DATA['username']) && isset($DATA['password']) )) {
       __LOGIN($DATA, $conn);
    }else {
        print(json_encode(['status' => 'ERROR', 'message' => 'NOT FOUND']));
    }
    
}



?>