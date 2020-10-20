<?php


namespace App\Models;


use Database\DBConnection;

class Client extends Model {

    protected static $table = 'Client';

    public static function getTable(): string {
        return self::$table;
    }

    public static function isConnected(string $username, string $password) {
        $tableName = self::$table;
        $tableJoin = Profil::getTable();
        $stmt = DBConnection::getPDO()->prepare("SELECT count(id)
            FROM {$tableName}
            NATURAL JOIN {$tableJoin}
            WHERE pseudo = ? AND pwd = ?");
        $stmt->execute([$username, sha1($password)]);
        return $stmt->fetchColumn();
    }
}