<?php

namespace Database;

use PDO;


class DBConnection {

    private $host;
    private $dbName;
    private $username;
    private $password;
    private $pdo;

    public function __construct(string $host, string $dbName, string $username, string $password) {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPDO(): PDO {
        return $this->pdo ?? $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
        ]);
    }
}