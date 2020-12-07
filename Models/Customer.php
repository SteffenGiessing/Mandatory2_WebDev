<?php
require_once('../DB_Handler/DB_con.php');

class customer extends DB_Connect
{   
    //ValidateLogin
    function validateLogin ($email, $password){

        $query =<<<'SQL'
        SELECT Email, Password 
        FROM customer 
        WHERE Email = ?;
SQL;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        if ($stmt->rowCount()===0){
            return false;
        }
        $row = $stmt->fetch();

        $this->email = $email;
        //Checks the password
        return (password_verify($password, $row['Password']));

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
}
?>