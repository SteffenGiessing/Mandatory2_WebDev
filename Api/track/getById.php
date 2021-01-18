<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../Models/Tracks.php");
$track = new Tracks;

if(isset($_GET["id"])){

    $id = trim($_GET["id"]);

    http_response_code(200);
    echo json_encode($track->getById($id));
} else {
    http_response_code(503);
    echo json_encode(array("Message" => "Unable to get track by id"));
}
?>