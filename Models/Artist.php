<?php
require_once("../../DB_Handler/DB_con.php");

class Artist extends DB_Connect{

    function create($name) {
        $result = array();
        try {
            $query = <<<SQL
                INSERT INTO artist (Name) 
                VALUES (?);
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$name]);

            $affectedRows = $stmt->rowCount();
            if ($affectedRows == 0) {
                $result['isArtistCreated'] = false;
            } else {
                $result['isArtistCreated'] = true;
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

    function update($id, $name) {
        $result = array();
        try {
            $query = <<<SQL
                UPDATE artist 
                SET Name = ?
                WHERE ArtistId = ?
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$name, $id]);

            $affectedRows = $stmt->rowCount();
            
            if ($affectedRows == 0) {
                $result['isArtistUpdated'] = false;
            } else {
                $result['isArtistUpdated'] = true;
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
    
    function delete($id) {
        $result = array();
        try {
            $query = <<<SQL
            DELETE FROM artist WHERE ArtistId = ?;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);
            $deletedRows = $stmt->rowCount();
            
            if ($deletedRows == 0) {
                $result['isArtistDeleted'] = false;
            } else {
                $result['isArtistDeleted'] = true;
            }

            $result['deletedRows'] = $deletedRows;
            $this->disconnect();

        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
            return false;
        }
        return $result;
    }
    function getById($id) {
        try {
            $query = <<<SQL
            SELECT A.ArtistId AS artistId, A.Name as name, GROUP_CONCAT(DISTINCT(AL.Title) SEPARATOR ', ') AS albums, GROUP_CONCAT(DISTINCT(T.Name) SEPARATOR ', ') AS tracks, G.Name AS genre
            FROM artist A
            LEFT JOIN album AL ON A.ArtistId = AL.ArtistId
            LEFT JOIN track T ON T.AlbumId = AL.AlbumId
            LEFT JOIN genre G ON G.GenreId = T.GenreId
            WHERE A.ArtistId = ?;           
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
    
    function getAll($offset, $from){
        $offset = (int)$offset;
        $from = (int)$from;
        $counter = 0;
        $result = array();

        try {
            $query = <<<SQL
            SELECT SQL_CALC_FOUND_ROWS A.ArtistId AS artistId, A.Name AS artist, COUNT(DISTINCT(AL.Title)) AS numOfAlbums, COUNT(T.AlbumId) AS numOfTracks, G.Name AS genres
            FROM artist A
            LEFT JOIN album AL ON AL.ArtistId = A.ArtistId
            LEFT JOIN track T ON T.AlbumId = AL.AlbumId
            LEFT JOIN genre G ON G.GenreId = T.GenreId
            GROUP BY A.Name
            LIMIT $from, $offset;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
                
            while ($row = $stmt->fetch()){ 
                extract($row);
                $result[$counter]['artistId'] = $row['artistId'];
                $result[$counter]['artist'] = $row['artist'];
                $result[$counter]['numOfAlbums'] = $row['numOfAlbums'];
                $result[$counter]['numOfTracks'] = $row['numOfTracks'];
                $result[$counter]['genres'] = $row['genres'];
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
    function searchArtist($searchVal, $offset, $from) {
        $search = '%' . $searchVal . '%';
        $offset = (int)$offset;
        $from = (int)$from;
        $counter = 0;
        $result = array();

        try {
            $query = "SELECT SQL_CALC_FOUND_ROWS A.ArtistId AS artistId, A.Name AS artist, COUNT(DISTINCT(AL.Title)) AS numOfAlbums, COUNT(T.AlbumId) AS numOfTracks, G.Name AS genres
                        FROM artist A
                        LEFT JOIN album AL ON AL.ArtistId = A.ArtistId
                        LEFT JOIN track T ON T.AlbumId = AL.AlbumId
                        LEFT JOIN genre G ON G.GenreId = T.GenreId
                        WHERE CONCAT_WS('', A.Name, G.Name) LIKE ?
                        GROUP BY A.Name
                        LIMIT $from, $offset;";         

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$search]);
            
            while ($row = $stmt->fetch()){ 
                extract($row);
                $result[$counter]['artistId'] = $row['artistId'];
                $result[$counter]['artist'] = $row['artist'];
                $result[$counter]['numOfAlbums'] = $row['numOfAlbums'];
                $result[$counter]['numOfTracks'] = $row['numOfTracks'];
                $result[$counter]['genres'] = $row['genres'];
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