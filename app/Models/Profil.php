<?php


namespace App\Models;


use Database\DBConnection;

class Profil extends Model {

    protected static $table = 'profilmpa';

    public static function getTable(): string {
        return self::$table;
    }

    public function updatePassword(string $username, string $lastPassword, string $newPassword) {
        $tableName = self::$table;
        $stmt = DBConnection::getPDO()->prepare("UPDATE {$tableName} SET pwd = ? WHERE pseudo = ? AND pwd = ?");
        $stmt->execute([sha1($newPassword), $username, sha1($lastPassword)]);
        return $stmt->rowCount();
    }
}