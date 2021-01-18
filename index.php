<?php
    session_start();
    if(isset($_SESSION['userId'])){
        require_once('Html_Css/home.php');
    } else {
        require_once('Html_Css/login.php');
    }
?>