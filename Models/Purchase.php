<?php
require_once('../../DB_Handler/DB_con.php');
class Purchase extends DB_Connect{
    function createInvoice($userId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $price) {
      //try {
      $query =<<<'SQL'
            INSERT INTO invoice(
            CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total)
            VALUES (?,?,?,?,?,?,?,?);
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$userId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $price]);

            $this->disconnect();
      //}catch (PDOException $e){
         //   die('{"status:" "error", "connection": "' . $e->getMessage() . '"}');
         //   exit();
      //}
      return true;
    }

    function getCurrentProfile($userId) {
        try {
          $query = <<<'SQL'
          SELECT Address, City, State, Country, PostalCode 
          FROM customer WHERE CustomerId = ?
SQL;
          $stmt = $this->pdo->prepare($query);
          $stmt->execute([$userId]);

          $result = $stmt->fetch();
          $this->disconnect();
        } catch (PDOException $e){
          die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
          exit();
        }
        return $result;
    }


  }
?>