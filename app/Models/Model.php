<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

abstract class Model {

    public static function getTable(): string {
        throw new \Exception('overload required');
    }

    public static function all(): array {
        $table = static::getTable();
        $stmt = DBConnection::getPDO()->query("SELECT * FROM {$table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }

    public static function findById(int $id, array $infosRequired = []): Model {
        $table = static::getTable();
        $columns = $infosRequired ? implode(', ', $infosRequired) : '*';

        $stmt = DBConnection::getPDO()->prepare("SELECT {$columns} FROM {$table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function getColumns(array $infosRequired) {
        $table = static::getTable();
        $columns = implode(', ', $infosRequired);
        $stmt = DBConnection::getPDO()->query("SELECT {$columns} FROM {$table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }
}