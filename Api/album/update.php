<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// get posted data
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id) && !empty($data->title && !empty($data->artistId))){
    require_once("../../Models/Album.php");
    $album = New Album;

    $id =trim($data->id);
    $title = trim($data->title);
    $artistId = trim($data->artistId);

    $results = $album->update($id, $title, $artistId);

    if($results["isAlbumUpdated"]) {
        http_response_code(200);
    } else {
        http_response_code(404);
    }

    echo json_encode($results);
} else {
    http_response_code(503);

    echo json_encode(array("message" => "Unable to get Create Artist"));
}