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

    public static function getImpayes(string $dateDebut, string $dateFin) {
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
}