<?php
require_once('../../DB_Handler/DB_con.php');
class profile extends DB_Connect {
    
    function getProfile($id) {
      $id = (int)$id;
      $result = array();
      try {
      $query =<<<SQL
        SELECT FirstName, LastName, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email 
        FROM customer
        WHERE CustomerId = ?
SQL;
      
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        while($row = $stmt->fetch()){
            extract($row);
            $result["FirstName"] = $row["FirstName"];
            $result["LastName"] = $row["LastName"];
            $result["Company"] = $row["Company"];
            $result["Address"] = $row["Address"];
            $result["City"] = $row["City"];
            $result["State"] = $row["State"];
            $result["Country"] = $row["Country"];
            $result["PostalCode"] = $row["PostalCode"];
            $result["Phone"] = $row["Phone"];
            $result["Fax"] = $row["Fax"];
            $result["Email"] = $row["Email"];
        }
        $stmt = $this->pdo->prepare("SELECT FOUND_ROWS()");
        $stmt->execute();
        $maxRows = $stmt->fetchColumn();
        array_push($result, $maxRows);
        $this->disconnect();
      }catch (PDOException $e) {
        die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
        exit(); 
      }
        return $result;
    }

    function editProfile($firstName, $lastName,$company,$address,$city,$state,$country,$postalcode,$phone,$fax,$email) {
        $query = <<<'SQL'
        UPDATE customer SET FirstName = ?, LastName = ?, Company = ?, Address = ?, City = ?, State = ?, Country = ?, PostalCode = ?, Phone = ?, Fax = ?, Email = ? WHERE CustomerId = ?;
SQL;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$firstName, $lastName,$company,$address,$city,$state,$country,$postalcode,$phone,$fax,$email, $_SESSION['userId']]);
        $this->disconnect();
        return true;
    }
    function changePassword($password){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = <<<'SQL'
        UPDATE customer SET Password = ? WHERE CustomerId = ?;
SQL;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$password, $_SESSION['userId']]);
        $this->disconnect();
        return true;
      }
    }
?>