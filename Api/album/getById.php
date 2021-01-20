<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../Models/Album.php");
$album = new Album;

if(isset($_GET["id"])){
    $id = trim($_GET["id"]);

    http_response_code(200);
    echo json_encode($album->getById($id));
} else {
    http_response_code(500);
    echo json_encode(array("message" => "Unable to get Album"));
}