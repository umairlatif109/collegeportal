<?php 
header('Access-Control-Allow-Origin: *'); 
header('Content-Type:application/json');


$json = file_get_contents("php://input");


echo $token = bin2hex(random_bytes(64));
$data = json_decode($json, true);
// echo $json;
echo json_encode($_GET);
 ?>