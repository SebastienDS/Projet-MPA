<?php


namespace App\Models;


use Database\DBConnection;

class Admin extends Model {

    protected static $table = 'Admin';

    public static function getTable(): string {
        return self::$table;
    }

    public function isConnected(string $username, string $password) {
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