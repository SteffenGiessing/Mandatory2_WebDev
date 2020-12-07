<?php
class Genre extends DB_Connect{

        function get($id)
        {
            $query = <<<'SQL'
            SELECT GenreId, Name
            FROM track 
            WHERE GenreId = ?;
SQL;
    $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);
            $results = $stmt->fetch();
            $this->disconnect();
            return $results;
    
        }

    }
?>