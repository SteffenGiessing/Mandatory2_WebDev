<?php
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=UTF-8");
    
    require_once("../../Models/User.php");
    $user = new User;
    
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->loginEmail) && isset($data->loginPassword)) {
        $loginEmail = trim($data->loginEmail);
        $loginPassword = trim($data->loginPassword);
        
        http_response_code(200);
        echo json_encode($user->validateLogin($loginEmail, $loginPassword));
    } else {
        http_response_code(400);

        echo json_encode(array("message" => "Bad Request"));
    }
?>