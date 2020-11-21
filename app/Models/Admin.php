<?php


namespace App\Models;


use Database\DBConnection;

class Admin extends Model {

    public static function getTable(): string {
        return 'Admin';
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
}