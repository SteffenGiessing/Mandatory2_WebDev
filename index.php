<?php
    session_start();
    if(isset($_SESSION['userId'])){
        require_once('home.php');
    } else {
        require_once('login.php');
    }
    include_once('DB_Handler/DB_con.php');
    include_once('Api/api.php');
?>