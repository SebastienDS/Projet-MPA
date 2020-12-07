<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Client extends Model {

    public static function getTable(): string {
        return 'Client';
    }

    public static function isConnected(string $username, string $password) {
        $tableName = self::getTable();
        $tableJoin = Profil::getTable();
        $stmt = DBConnection::getPDO()->prepare("SELECT count(id)
            FROM {$tableName}
            NATURAL JOIN {$tableJoin}
            WHERE pseudo = ? AND pwd = ?");
        $stmt->execute([$username, sha1($password)]);
        return $stmt->fetchColumn();
    }

    public static function create(int $id) {
        $table = static::getTable();

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO {$table} (id) VALUES (?)");
        $stmt->execute([$id]);
    }

    public static function getColumns(array $infosRequired) {
        $table = static::getTable();
        $profilTable = Profil::getTable();

        $columns = implode(', ', $infosRequired);
        $stmt = DBConnection::getPDO()->query("SELECT {$columns} FROM {$table} NATURAL JOIN {$profilTable}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }
}