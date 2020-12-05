<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Compte extends Model {

    public static function getTable(): string {
        return 'Compte';
    }

    public static function getInfos(int $profilId): array {
        $tableName = self::getTable();
        $transactionTable = Transaction::getTable();

        $stmt = DBConnection::getPDO()->prepare("SELECT idCompte as id, nomCompte as nom, count(idCompte) as nombreTransactions, solde 
            FROM {$tableName} as c NATURAL JOIN {$transactionTable} WHERE id = ? GROUP BY idCompte");
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

}