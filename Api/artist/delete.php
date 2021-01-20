<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(!empty($data->id)) {
    
    require_once('../../Models/Artist.php');
    $artist = new Artist;
    $id = trim($data->id);
    
    $result = $artist->delete($id);
    if ($result['isArtistDeleted']) {
        http_response_code(200);
    } else {
        http_response_code(404);
    }
    echo json_encode($result);

} else {
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete Artist.", "id" => $id));
}