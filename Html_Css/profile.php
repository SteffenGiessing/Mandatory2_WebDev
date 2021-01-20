<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../javascript/jquery-3.5.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../javascript/functions.js"></script>
    <script type="text/javascript" src="../javascript/profile.js"></script>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
<?php
    session_start();
    include("header.php");
    if(!isset($_SESSION['userId'])) {
        header("Location: login.php?");
        die();
    }
?>

<main>
    <div class="editUser">
        <div class="form">
                <input type="text" id="firstname">
                <input type="text" id="lastname">
                <input type="text" id="company">
                <input type="text" id="address">
                <input type="text" id="city">
                <input type="text" id="state">
                <input type="text" id="country">
                <input type="text" id="postalcode">
                <input type="text" id="phone">
                <input type="text" id="fax">
                <input type="text" id="email">
                <button class="submitEditUser">Edit</button>
                <input type="text" id="password">
                <button class="editPassword">Change Password</button>
        </div>
    </div>
    </div>
    <div id="snackbar">Successfully Updated!</div>
</main>
</body>
</html>