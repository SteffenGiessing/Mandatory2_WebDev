<?php
session_start();

     if(!isset($_POST['entity']) || !isset($_POST['action'])){
         echo 'Error';
     } else {
        $entity = $_POST['entity'];
        $action = $_POST['action'];
       
        switch($entity){
            case "tracks":
                require_once("../Models/Tracks.php");
                $tracks = new Tracks;
                switch($action){
                case "getTracksArtistAlbum":
                    echo json_encode($tracks->getTrackAlbumArtist($_POST['searchVal']));
                break;
                case "getTracks":
                    echo json_encode($tracks->getTracks());
                break;
                }
            break;
            case 'album':
                require_once('../Models/Album.php');
                $album = new Album;
                switch($action){
                    case 'getAlbum':
                        echo json_encode($album->getAlbum());
                    break;
                    }
                break;
            case 'user':
                require_once('../Models/User.php');
                $user = new User;
                switch ($action) {
                case 'createuser':
                    echo json_encode($user->createAccount($_POST['firstName'], $_POST['lastName'], $_POST['password'], $_POST['company'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['postalCode'], $_POST['phone'], $_POST['fax'], $_POST['email']));
                break;
                case 'loginuser':
                    echo json_encode($user->validateLogin($_POST['loginEmail'], $_POST['loginPassword']));
                break;
                case 'signOut':
                    echo json_encode($user->signOut());
                break;
            }
            case 'profile':
                require_once('../Models/Profile.php');
                $profile = new Profile;
                switch ($action){
                case "getProfile":
                    echo json_encode($profile->getProfile());
                break;
                case "editProfile":
                    echo json_encode($profile->editProfile($_POST['firstNameChange']));
                break;
                case "changePassword":
                    echo json_encode($profile->changePassword($_POST['password']));
                }
            break;
        }
   }  

?>