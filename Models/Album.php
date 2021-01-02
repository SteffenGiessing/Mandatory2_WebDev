<?php
require_once('../DB_Handler/DB_con.php');

class album extends DB_Connect {

    function getAlbum (){
       
        $query =<<<'SQL'
        SELECT Title
        FROM album;
        
        
SQL;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->disconnect();
        return $row;
        }
    }
//WHERE AlbumId = ?;

?>