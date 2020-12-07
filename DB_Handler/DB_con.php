<?php

class DB_Connect {
    protected $pdo;

    public function __construct() {
        require_once('conn_info.php');
       
        $dsn = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->pdo = @new PDO($dsn, $user, $pwd, $options);
        } catch (\PDOException $e) {
            echo 'Connection unsuccessful';
            die('Connection unsuccessful: ' . $e->getMessage());
            exit();
        }
    }

    public function disconnect()
    {
        $this->pdo = null;
    }
}

