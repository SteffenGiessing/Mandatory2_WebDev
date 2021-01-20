<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../Models/Artist.php');
$artist = new Artist;

if(isset($_GET["searchVal"])){
    $searchVal = trim($_GET["searchVal"]);
    if(isset($_GET["from"]) || (isset($_GET["offset"]))) {
        $offset = trim($_GET["offset"]);
        $from = trim($_GET["from"]);        
    } else {
        $from = 0;
        $offset = 4000;
    }
    http_response_code(200);
    echo json_encode($artist->searchArtist($searchVal, $offset, $from));
} else {
    
    http_response_code(503);

    echo json_encode(array("message" => "Unable to get artist"));
}