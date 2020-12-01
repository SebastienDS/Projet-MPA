<?php


namespace App\Models;

use PDO;
use Database\DBConnection;

class Transaction extends Model {

    public static function getTable(): string {
        return 'Transaction';
    }

    public static function getDates(): array {
        $table = self::getTable();
        $stmt = DBConnection::getPDO()->query("SELECT datetr FROM {$table} ORDER BY datetr");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetchAll();
    }

    public static function getImpayes(string $dateDebut, string $dateFin): array {
        $table = self::getTable();
        $stmt = DBConnection::getPDO()->prepare("SELECT 
                CONCAT(MONTHNAME(datetr), ' ', YEAR(datetr)) AS date, 
                - IFNULL(LEAST(SUM(CASE WHEN moyenPay = 'CB' THEN MTrans END), 0), 0) AS CB,
                - IFNULL(LEAST(SUM(CASE WHEN moyenPay = 'Visa' THEN MTrans END), 0), 0) AS Visa,
                - IFNULL(LEAST(SUM(CASE WHEN moyenPay = 'MC' THEN MTrans END), 0), 0) AS Mastercard
            FROM Transaction
            WHERE datetr >= ? AND datetr <= ?
            GROUP BY date 
            ORDER BY datetr");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute([$dateDebut, $dateFin]);
        return $stmt->fetchAll();
    }

    public static function getInfos(int $idCompte, string $orderBy = 'datetr', string $orderdirection = 'DESC', array $where = []): array {
        $table = self::getTable();
        $entrepriseTable = Entreprise::getTable();

        $queryCondition = implode(' and ', array_map(function($condition) use ($where) {
            return "`$condition` = :$condition";
        }, array_keys($where)));

        if ($queryCondition) {
            $queryCondition = "HAVING {$queryCondition}";
        }
        $where['id'] = $idCompte;

        $stmt = DBConnection::getPDO()->prepare("SELECT NSIREN as siren, Raison_Sociale as raisonSociale, 
            datetr as date, count(datetr) as nombreTransactions, 'Euro', moyenPay, sum(Mtrans) as montantTotal 
            FROM {$table} JOIN {$entrepriseTable} on NSIREN = N_SIREN WHERE id = :id GROUP BY datetr, NSIREN {$queryCondition} ORDER BY {$orderBy} {$orderdirection}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute($where);
        return $stmt->fetchAll();
    }
}