<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// get posted data
$data = json_decode(file_get_contents("php://input"));
require_once("../sanitizer/sanitizer.php");
// make sure data is not empty
// Composer is left out since it is possible for a track to have no composers
if(
    !empty($data->name) &&
    !empty($data->albumId) &&
    !empty($data->mediaTypeId) &&
    !empty($data->genreId) &&
    !empty($data->milliseconds) &&
    !empty($data->bytes) &&
    !empty($data->unitPrice)
    ){
    require_once('../../Models/Tracks.php');
    $track = new Tracks;
    
    $name = sanitize_input($data->name); 
    $albumId = trim($data->albumId); 
    $mediaTypeId = trim($data->mediaTypeId); 
    $genreId = trim($data->genreId); 
    $composer = trim($data->composer); 
    $milliseconds = trim($data->milliseconds); 
    $bytes = trim($data->bytes); 
    $unitPrice = trim($data->unitPrice); 

    http_response_code(201);
    echo json_encode($track->create($name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice));

} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get Create Track"));
}
?>