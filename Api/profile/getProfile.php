<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../Models/Profile.php");
$profile = new Profile;

if(isset($_SESSION["userId"])){
    
    $id = $_SESSION["userId"];
    http_response_code(200);    
    echo json_encode($profile->getProfile($_SESSION["userId"]));
} else {
    http_response_code(500);
    
    echo json_encode(array("message" => "Bad Request"));

}
?>