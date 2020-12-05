<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Compte extends Model {

    public static function getTable(): string {
        return 'Compte';
    }

    public static function getInfos(int $profilId): array {
        $tableName = static::getTable();
        $transactionTable = Transaction::getTable();

        $stmt = DBConnection::getPDO()->prepare("SELECT idCompte as id, nomCompte as nom, count(idCompte) as nombreTransactions, solde 
            FROM {$tableName} as c NATURAL LEFT JOIN {$transactionTable} WHERE id = ? GROUP BY idCompte");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute([$profilId]);
        return $stmt->fetchAll();
    }

    public static function findById(int $id, array $infosRequired = []): Model {
        $table = static::getTable();
        $columns = $infosRequired ? implode(', ', $infosRequired) : '*';

        $stmt = DBConnection::getPDO()->prepare("SELECT {$columns} FROM {$table} WHERE idCompte = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create(int $id, string $nomCompte) {
        $table = static::getTable();

        $stmt = DBConnection::getPDO()->prepare("INSERT INTO {$table} (nomCompte, solde, id) VALUES (?, 0, ?)");
        $stmt->execute([$nomCompte, $id]);
    }

    public static function delete(int $idCompte) {
        $table = static::getTable();

        $stmt = DBConnection::getPDO()->prepare("DELETE FROM {$table} WHERE idcompte = ?");
        $stmt->execute([$idCompte]);
    }
}