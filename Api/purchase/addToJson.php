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
    $title = trim($data->title);
    $album = trim($data->album);
    $price = trim($data->price);

    http_response_code(200);
    echo json_encode($purchase->addToJson($title, $album,$price));
} else {
    http_response_code(503);
    echo json_encode(array("Message" => "Unable to store in json"));
}
?>