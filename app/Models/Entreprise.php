<?php


namespace App\Models;


use Database\DBConnection;
use PDO;

class Entreprise extends Model {

    public static function getTable(): string {
        return 'Entreprise';
    }

    public static function getImpayes(string $orderBy='N_SIREN', string $orderdirection='ASC', array $where=[], int $page=NULL, int $rowPerPages=NULL): array {
        $table = static::getTable();
        $transactionTable = Transaction::getTable();

        $queryCondition = implode(' and ', array_map(function($condition){
            return "`$condition` = :$condition";
        }, array_keys($where)));

        if ($queryCondition) {
            $queryCondition = "HAVING {$queryCondition}";
        }

        $queryLimit = '';
        if ($page !== NULL) {
            $queryLimit .= 'LIMIT '. $page * $rowPerPages;
            if ($rowPerPages !== NULL) {
                $queryLimit .= ", $rowPerPages";
            }
        }

        $stmt = DBConnection::getPDO()->prepare("SELECT N_SIREN as siren, Raison_Sociale as raisonSociale, sum(CASE WHEN Mtrans < 0 THEN MTrans END) as impayes FROM 
            {$table} NATURAL JOIN {$transactionTable} GROUP BY N_SIREN {$queryCondition} ORDER BY {$orderBy} {$orderdirection} {$queryLimit}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute($where);
        return $stmt->fetchAll();
    }

    public static function getImpayesCount() {
        $table = static::getTable();
        $transactionTable = Transaction::getTable();

        $stmt = DBConnection::getPDO()->query("SELECT 1 FROM {$table} 
            NATURAL JOIN {$transactionTable} GROUP BY N_SIREN");
        return $stmt->rowCount();
    }
}