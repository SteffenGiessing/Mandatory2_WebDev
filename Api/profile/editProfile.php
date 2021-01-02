<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../Models/Profile.php");
$profile = new Profile;

$data = json_decode(file_get_contents("php://input"));

if(isset($_SESSION["userId"])) {

    $firstName = trim($data->firstNameChange); 
    $lastName = trim($data->lastNameChange); 
    $company = trim($data->compnayChange); 
    $address = trim($data->addressChange); 
    $city = trim($data->cityChange); 
    $state = trim($data->stateChange); 
    $country = trim($data->countryChange); 
    $postalcode = trim($data->postalCodeChange); 
    $phone = trim($data->phoneChange); 
    $fax = trim($data->faxChange); 
    $email = trim($data->emailChange); 

    http_response_code(200);
    echo json_encode(array("Update Profile" => $profile->editProfile($firstName, $lastName,$company,$address,$city,$state,$country,$postalcode,$phone,$fax,$email)));
} else {
    http_response_code(501);
    echo json_encode(array("Something Went Wrong" => "Bad Request"));
}

?>