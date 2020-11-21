<?php


namespace App\Models;


use Database\DBConnection;

class Profil extends Model {

    public static function getTable(): string {
        return 'Profilmpa';
    }
    public static function updatePassword(string $username, string $lastPassword, string $newPassword) {
        $tableName = self::getTable();
        $stmt = DBConnection::getPDO()->prepare("UPDATE {$tableName} SET pwd = ? WHERE pseudo = ? AND pwd = ?");
        $stmt->execute([sha1($newPassword), $username, sha1($lastPassword)]);
        return $stmt->rowCount();
    }
}