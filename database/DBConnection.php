<?php

namespace Database;

use PDO;


class DBConnection {

    private static $_instance;

    private $host;
    private $dbName;
    private $username;
    private $password;
    private $pdo;

    private function __construct(string $host, string $dbName, string $username, string $password) {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
        ]);
    }

    public static function getPDO(): PDO {
        return (self::$_instance ?? self::$_instance = new DBConnection(DB_HOST, DB_NAME, DB_USER, DB_PWD))->pdo;
    }
}