<?php
    if(isset($_POST["purchase"])){
        if(isset($_COOKIE["shopping_cart"])){
            $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_list = array_column($cart_data, 'item_id');

        if(in_array($_POST["hidden_id"],  $item_list)){

            foreach($cart_data as $keys => $values){
                if($cart_data[$keys]["item_id"] == $_POST["hidden_id"]){
                    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
                }
            }
        }
        else {
            $item_array = array(
                "item_id" => $_POST["hidden_id"],
                "item_album" => $_POST["hidden_album"],
                "item_genre" => $_POST["hidden_genre"],
                "item_composer" => $_POST["hidden_composer"],
                "item_price" => $_POST["hidden_price"],
                "item_quantity" => $_POST["quantity"]
            );
            $cart_data[] = $item_array;
        }
        $item_data = json_encode($cart_data);
        setcookie("shopping_cart", $item_data, time()+ (86400 *30));
    }
    ?>