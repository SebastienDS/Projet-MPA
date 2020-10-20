<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

abstract class Model {

    protected static $table;

    public static function all(): array {
        $table = self::$table;
        $stmt = DBConnection::getPDO()->query("SELECT * FROM {$table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }

    public static function findById(int $id): Model {
        $table = self::$table;
        $stmt = DBConnection::getPDO()->prepare("SELECT * FROM {$table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}