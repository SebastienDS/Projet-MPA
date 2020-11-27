<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Compte extends Model {

    public static function getTable(): string {
        return 'Compte';
    }

    public static function getInfos(): array {
        $tableName = self::getTable();
        $transactionTable = Transaction::getTable();

        $stmt = DBConnection::getPDO()->query("SELECT idCompte as id, nomCompte as nom, count(t.id) as nombreTransactions, solde 
            FROM {$tableName} JOIN {$transactionTable} AS t ON t.id = idCompte GROUP BY t.id");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }
}