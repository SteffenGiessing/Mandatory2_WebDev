<?php

require_once('../../DB_Handler/DB_con.php');

class User extends DB_Connect
{   
    //ValidateLogin
    function validateLogin ($email, $password){
        $result = [];
        try {
        $query =<<<SQL
        SELECT CustomerId, FirstName, LastName, Password, Email, Password 
        FROM customer 
        WHERE Email = ?;
SQL;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);

        if ($stmt->rowCount()===0){
            $query = "SELECT Password FROM admin";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();    
        
            $adminPassword = $stmt->fetch();
            
            if(password_verify($password, $adminPassword["Password"])) {
                $_SESSION['userId'] = 0;
                $_SESSION['isAdmin'] = 1;
                $result['isValid'] = true;
                $result['isAdmin'] = true;
                return $result;
            } else {
                $result['isValid'] = false;
                return $result;
            }
        }
    
    
            $row = $stmt->fetch();


            if(password_verify($password, $row["Password"])){
                $_SESSION['userId'] = $row['CustomerId'];
                $_SESSION['firstName'] = $row['FirstName'];
                $_SESSION['lastName'] = $row['LastName'];
                $_SESSION['email'] = $email;
                $_SESSION['isAdmin'] = 0;
                $result['isValid'] = true;
                $result['isAdmin'] = false;
            } else {
                $result['isValid'] = false;
            }
            
            $this->disconnect();

        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
        }

        return $result;
    }

    //Create an account. 
    function createAccount(
        $firstName,
        $lastName,
        $password,
        $company,
        $address,
        $city,
        $state,
        $country,
        $postalCode,
        $phone,
        $fax,
        $email
    ) {
      
        $query = <<<'SQL'
                SELECT COUNT(*) AS total FROM customer WHERE Email = ?;
SQL;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        if ($stmt->fetch()['total'] > 0) {
            return false;
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = <<<'SQL'
            INSERT INTO customer(
            FirstName, LastName, Password, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?);
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email]);

            $this->disconnect();
            return true;
        }
    }

function signOut () {
    session_destroy();
    return "User Logged Out";
}
}
?>