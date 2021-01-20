<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../Models/Purchase.php");
$purchase = new Purchase;

$data = json_decode(file_get_contents("php://input"));

if(isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];

    http_response_code(201);
    echo json_encode($purchase->getCurrentProfile($userId));
} else {
    http_response_code(500);
    echo json_encode(array("Message" => "Unable to get user"));
}
?>