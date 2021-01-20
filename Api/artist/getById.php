<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../Models/Artist.php');
$artist = new Artist;

if(isset($_GET["id"])){
    $id = trim($_GET["id"]);

    http_response_code(200);
    echo json_encode($artist->getById($id));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to get Artist"));
}