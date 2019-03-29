<?php
header('Access-Control-Allow-Origin: *'); 
$user = array(
        'email' => null,
        'token' => null,
        'login' => false,
    );
$post_request = file_get_contents("php://input");

$token = bin2hex(random_bytes(64));

$email = "abdul@m.com";
$password = "123";

$post_data = json_decode($post_request, true);
if($post_data['email'] == $email && $post_data['password'] == $password){
    $user = array(
        'email' => $post_data['email'],
        'token' => $token,
        'login' => true,
    );
    echo json_encode($user);
}else{
    echo json_encode($user);
}

 ?>
