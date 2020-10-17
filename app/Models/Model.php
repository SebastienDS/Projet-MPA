<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

abstract class Model {

    protected static $table;

    public function all(): array {
        $stmt = DBConnection::getPDO()->query("SELECT * FROM {$this::$table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): Model {
        $stmt = DBConnection::getPDO()->prepare("SELECT * FROM {$this::$table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}