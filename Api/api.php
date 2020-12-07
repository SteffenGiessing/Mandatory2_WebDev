<?php


     if(!isset($_POST['entity']) || !isset($_POST['action'])){
         echo 'Error';
     } else {
        $entity = $_POST['entity'];
        $action = $_POST['action'];
       
        switch($entity){
          
            case 'customer':
                require_once('../Models/Customer.php');
                $customer = new Customer;
                switch ($action) {
                case 'createCustomer':
                //echo json_encode($customer->create("fornavn", "Efternavn", "adgangskode", "Selskab", "Adresse", "By", "Stat", "Land", "4960", "28272625", "faaaax", "mail@mail.dk"));
                    echo json_encode($customer->createAccount($_POST['firstName'], $_POST['lastName'], $_POST['password'], $_POST['company'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['postalCode'], $_POST['phone'], $_POST['fax'], $_POST['email']));
                break;
                case 'loginCustomer':
                    echo json_encode($customer->validateLogin($_POST['loginEmail'], $_POST['loginPassword']));
                break;
            }
        }
   }  

?>