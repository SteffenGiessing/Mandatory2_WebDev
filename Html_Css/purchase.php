<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../javascript/jquery-3.5.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../javascript/functions.js"></script>
    <script type="text/javascript" src="../javascript/purchase.js"></script>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
<body>
    <?php 
        session_start();
        include("header.php");
        if(!isset($_SESSION["userId"])) {
            header("Location: login.php?");
            die();
        }
        if(isset($_GET["action"])){
            if($_GET["action"] == "delete") {
                $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
                $cart_data = json_decode($cookie_data, true);
                foreach($cart_data as $keys => $values) {
                    if($cart_data[$keys]["item_id"] == $_GET["id"]){
                        unset($cart_data[$keys]);
                        $item_data = json_encode($cart_data);
                        setcookie("shopping_cart", $item_data, time() + (86400 * 30));
                        header("location:http://localhost/Exam/Html_Css/purchase.php");
                    }
                }
            }
        }
    ?>

    <main>
    <table id="musicInfoTable">
        <tr>
            <th>Album</th>
            <th>Genre</th>
            <th>Composer</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price Pr Item</th>
            <th>Remove Item</th>
        </tr>
    <?php
    if(isset($_COOKIE["shopping_cart"])){
    $total = 0;
    $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
        {
    ?>
        <tr>
            <td><?php echo $values["item_album"]; ?></td>
            <td><?php echo $values["item_genre"]; ?></td>
            <td><?php echo $values["item_composer"]; ?>
            <td><?php echo $values["item_price"]; ?></td>
            <td><?php echo $values["item_quantity"]; ?></td>
            <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
            <td><a href="purchase.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Remove</span></a></td>

        </tr>
        <?php
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
        ?>
        <?php 
        } else {
            echo '<tr>
                    <td>No Item in Cart</td>
                    </tr>';
        }
        ?>
    </table>
    <div class="editUser">
        <div class="form">
            <p>Billing Address</p>
            <input type="text" id="billingAddress" placeholder="Billing Address">
            <p>Billing City</p>
            <input type="text" id="billingCity" placeholder="Billing City">
            <p>Billing State</p>
            <input type="text" id="billingState" placeholder="Billing State">
            <p>Billing Country</p>
            <input type="text" id="billingCountry" placeholder="Billing Country">
            <p>Billing Postal Code</p>
            <input type="text" id="billingPostalCode" placeholder="Postal Code">
            <p>Total Price: <?php echo $total ?></p>
            <input type="hidden" id="finalPrice" value="<?php echo $total ?>">
            <button class="createInvoice">Purchase</button>
        </div>
    </div>
</main>
</body>
</html>