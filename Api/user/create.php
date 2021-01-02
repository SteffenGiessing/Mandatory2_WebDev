<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../Models/User.php");
$user = new User;

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->firstName) &&
    !empty($data->lastName) &&
    !empty($data->password) &&
    !empty($data->company) &&
    !empty($data->address) &&
    !empty($data->city) &&
    !empty($data->state) &&
    !empty($data->country) &&
    !empty($data->postalCode) &&
    !empty($data->phone) &&
    !empty($data->fax) &&
    !empty($data->email)
) {
    $firstName = trim($data->firstName); 
    $lastName = trim($data->lastName); 
    $password = trim($data->password); 
    $company = trim($data->company); 
    $address = trim($data->address); 
    $city = trim($data->city); 
    $state = trim($data->state); 
    $country = trim($data->country); 
    $postalCode = trim($data->postalCode); 
    $phone = trim($data->phone); 
    $fax = trim($data->fax); 
    $email = trim($data->email); 

    http_response_code(201);
    echo json_encode(array("isUserCreated" => $user->createAccount($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email)));
} else {
    http_response_code(503);

    echo json_encode(array("message" => "Unable to create user"));
}
?>