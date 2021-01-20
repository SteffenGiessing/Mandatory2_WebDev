<?php
require_once("../../DB_Handler/DB_con.php");

class Album extends DB_Connect {
    
    function delete($id) {
        $result = array();
        try {
            $query = <<<SQL
            DELETE FROM album WHERE AlbumId = ?;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);
            $deletedRows = $stmt->rowCount();
            
            if ($deletedRows == 0) {
                $result['isAlbumDeleted'] = false;
            } else {
                $result['isAlbumDeleted'] = true;
            }

            $result['deletedRows'] = $deletedRows;
            $this->disconnect();

        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
        }
        return $result;
    }
    
    function update($id, $title, $artistId) {
        $result = array();
        try {
            $query = <<<SQL
                UPDATE album 
                SET Title = ?, ArtistId = ?
                WHERE AlbumId = ?
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$title, $artistId, $id]);

            $affectedRows = $stmt->rowCount();
            
            if ($affectedRows == 0) {
                $result['isAlbumUpdated'] = false;
            } else {
                $result['isAlbumUpdated'] = true;
            }
            $result['affectedRows'] = $affectedRows;
            $this->disconnect();

        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
        }
            return $result;
    }
    
    function create($name, $artistId) {
        $result = array();
        try {
            $query = <<<SQL
                INSERT INTO album (Title, ArtistId) 
                VALUES (?, ?);
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$name, $artistId]);

            $affectedRows = $stmt->rowCount();
            if ($affectedRows == 0) {
                $result['isAlbumCreated'] = false;
            } else {
                $result['isAlbumCreated'] = true;
            }
            $result['affectedRows'] = $affectedRows;
            $this->disconnect();
            
        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
            return false;
        }
            return $result;
    }

    function searchAlbum($searchVal, $offset, $from) {
        $search = '%' . $searchVal . '%';
        $offset = (int)$offset;
        $from = (int)$from;
        $counter = 0;
        $result = array();

        try {
            $query = <<<SQL
            SELECT SQL_CALC_FOUND_ROWS AL.AlbumId AS albumId, AL.Title AS title, A.Name AS artist, COUNT(T.TrackId) AS numOfTracks, SUM(T.UnitPrice) AS albumPrice  
            FROM album AL
            LEFT JOIN track T ON T.AlbumId = AL.AlbumId
            LEFT JOIN artist A ON A.ArtistId = AL.ArtistId
            WHERE CONCAT_WS('', AL.Title, A.Name) LIKE ?
            GROUP BY AL.Title        
            LIMIT $from, $offset;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$search]);

            while ($row = $stmt->fetch()){ 
                extract($row);
                $result[$counter]['albumId'] = $row['albumId'];
                $result[$counter]['title'] = $row['title'];
                $result[$counter]['artist'] = $row['artist'];
                $result[$counter]['numOfTracks'] = $row['numOfTracks'];
                $result[$counter]['albumPrice'] = $row['albumPrice'];
                $counter++;
            }

            $stmt = $this->pdo->prepare("SELECT FOUND_ROWS()");
            $stmt->execute();
            $maxRows = $stmt->fetchColumn();
            array_push($result, $maxRows);

            $this->disconnect();
        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
        }
        return $result;
    }


    function getById($id) {
        try {
            $query = <<<SQL
            SELECT AL.AlbumId AS albumId, AL.Title AS title, AL.ArtistId AS artistId, A.Name as artist, SUM(T.Milliseconds) AS totalPlaytime, GROUP_CONCAT(T.Name SEPARATOR ', ') AS tracks, G.Name AS genre, T.Composer AS composer, SUM(T.Bytes) AS totalFileSize, M.Name AS mediatype, SUM(T.UnitPrice) AS albumPrice  
            FROM album AL
            LEFT JOIN track T ON T.AlbumId = AL.AlbumId
            LEFT JOIN artist A ON A.ArtistId = AL.ArtistId
            LEFT JOIN genre G ON G.GenreId = T.GenreId
            LEFT JOIN mediatype M ON M.MediaTypeId  = T.MediaTypeId   
            WHERE AL.AlbumId = ?;           
SQL;
    
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);
        
            $result = $stmt->fetch();
    
            $this->disconnect();
        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
        }
        return $result;
    }

    function getAlbum (){
       
        $query =<<<"SQL"
        SELECT Title
        FROM album;
        
        
SQL;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->disconnect();
        return $row;
        }


    function getAll ($offset, $from){
        $offset = (int)$offset;
        $from = (int)$from;
        $counter = 0;
        $result = array();

        try{
            $query = <<<SQL
            SELECT SQL_CALC_FOUND_ROWS AL.AlbumId AS albumId, AL.Title AS title, A.Name AS artist, COUNT(T.AlbumId) AS numOfTracks, SUM(T.UnitPrice) AS albumPrice 
            FROM album AL
            LEFT JOIN track T ON T.AlbumId = AL.AlbumId
            LEFT JOIN artist A ON A.ArtistId = AL.ArtistId
            GROUP BY AL.Title
            LIMIT $from, $offset;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
                
            while ($row = $stmt->fetch()){ 
                extract($row);
                $result[$counter]["albumId"] = $row["albumId"];
                $result[$counter]["title"] = $row["title"];
                $result[$counter]["artist"] = $row["artist"];
                $result[$counter]["numOfTracks"] = $row["numOfTracks"];
                $result[$counter]["albumPrice"] = $row["albumPrice"];
                $counter++;
            }

            $stmt = $this->pdo->prepare("SELECT FOUND_ROWS()");
            $stmt->execute();
            $maxRows = $stmt->fetchColumn();
            array_push($result, $maxRows);

            $this->disconnect();
        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
        }
            return $result;
        }

    
    }    
?>