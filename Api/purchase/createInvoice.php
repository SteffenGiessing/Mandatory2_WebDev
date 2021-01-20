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
     $invoiceDate = date("Y-m-d h:i:s");
     $billingAddress = trim($data->billingAddress);
     $billingCity = trim($data->billingCity);
     $billingState = trim($data->billingState);
     $billingCountry = trim($data->billingCountry);
     $billingPostalCode = trim($data->billingPostalCode);
     $price = trim($data->price);

     http_response_code(201);
     echo json_encode(array("createInvoice" => $purchase->createInvoice($userId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $price)));
} else {
    http_response_code(503);
    echo json_encode(array("Message" => "Unable to create invoice"));
}
?>