<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

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

    public static function create(string $nom, string $prenom, string $password): int {
        $tableName = self::getTable();
        $pseudo = strtolower($prenom[0] . substr($nom, 0, 5));

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO {$tableName} (pseudo, nom, prenom, pwd) VALUES (?, ?, ?, ?)");
        $stmt->execute([$pseudo, $nom, $prenom, sha1($password)]);
        return DBConnection::getPDO()->lastInsertId();
    }

    public static function delete(int $id) {
        $tableName = self::getTable();
        $stmt = DBConnection::getPDO()->prepare("DELETE FROM {$tableName} WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function update(int $id, array $columnsUpdated) {
        $tableName = self::getTable();
        $passwordQuery = '';
        if (isset($columnsUpdated['password'])) {
            $passwordQuery = ', pwd = :password';
            $columnsUpdated['password'] = sha1($columnsUpdated['password']);
        }
        $columnsUpdated['id'] = $id;

        $stmt = DBConnection::getPDO()->prepare("UPDATE {$tableName} SET nom = :nom, prenom = :prenom {$passwordQuery} WHERE id = :id");
        $stmt->execute($columnsUpdated);
    }

    public static function getIdWhere(array $whereConditions): int {
        $tableName = self::getTable();
        $queryCondition = implode(' and ', array_map(function($condition) {
            return "$condition = :$condition";
        }, array_keys($whereConditions)));

        $stmt = DBConnection::getPDO()->prepare("SELECT id FROM {$tableName} WHERE {$queryCondition}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute($whereConditions);
        return $stmt->fetch()->id;
    }

    public static function exist(int $id): bool {
        $tableName = self::getTable();
        $stmt = DBConnection::getPDO()->prepare("SELECT id FROM {$tableName} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}