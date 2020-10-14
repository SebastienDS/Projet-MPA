<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

abstract class Model {

    private DBConnection $db;
    protected static string $table;

    public function __construct(DBConnection $db) {
        $this->db = $db;
    }

    public function getDB(): DBConnection {
        return $this->db;
    }

    public function all(): array {
        $stmt = $this->db->getPDO()->query("SELECT * FROM {$this::$table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): Model {
        $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this::$table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}