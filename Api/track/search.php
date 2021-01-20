<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../Models/Tracks.php");
$track = new Tracks;

// make sure data is not empty
if(isset($_GET["searchVal"])){
    $searchVal = trim($_GET["searchVal"]); 
    if(isset($_GET["from"]) || (isset($_GET["offset"]))) {
        $from = trim($_GET["from"]);
        $offset = trim($_GET["offset"]);
    } else {
        $from = 0;
        $offset = 4000;
    }
    
   
    http_response_code(200);
    echo json_encode($track->searchTracks($searchVal, $offset, $from));
} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get Track."));
}
?>