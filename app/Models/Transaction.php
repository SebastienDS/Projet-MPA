<?php


namespace App\Models;

use PDO;
use Database\DBConnection;

class Transaction extends Model {

    public static function getTable(): string {
        return 'Transaction';
    }

    public static function getDates(): array {
        $table = static::getTable();
        $stmt = DBConnection::getPDO()->query("SELECT datetr FROM {$table} ORDER BY datetr");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetchAll();
    }

    public static function getImpayes(string $dateDebut, string $dateFin, int $idClient): array {
        $table = static::getTable();
        $compteTable = Compte::getTable();

        $stmt = DBConnection::getPDO()->prepare("SELECT 
                CONCAT(MONTHNAME(datetr), ' ', YEAR(datetr)) AS date, 
                - IFNULL(LEAST(SUM(CASE WHEN moyenPay = 'CB' AND MTrans < 0 THEN MTrans END), 0), 0) AS CB,
                - IFNULL(LEAST(SUM(CASE WHEN moyenPay = 'Visa' AND MTrans < 0 THEN MTrans END), 0), 0) AS Visa,
                - IFNULL(LEAST(SUM(CASE WHEN moyenPay = 'MC' AND MTrans < 0 THEN MTrans END), 0), 0) AS Mastercard
            FROM {$table}
            WHERE datetr >= ? AND datetr <= ? AND idCompte IN (SELECT idcompte FROM {$compteTable} WHERE id = ?)
            GROUP BY date HAVING CB > 0 OR Visa > 0 OR Mastercard > 0
            ORDER BY datetr");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute([$dateDebut, $dateFin, $idClient]);
        return $stmt->fetchAll();
    }

    public static function getInfos(int $idCompte, string $orderBy='datetr', string $orderdirection='DESC', array $where=[], int $page=NULL, int $rowPerPages=NULL): array {
        $table = static::getTable();
        $entrepriseTable = Entreprise::getTable();

        $queryCondition = implode(' and ', array_map(function($condition) {
            return "`$condition` = :$condition";
        }, array_keys($where)));

        if ($queryCondition) {
            $queryCondition = "HAVING {$queryCondition}";
        }
        $where['id'] = $idCompte;

        $queryLimit = '';
        if ($page !== NULL) {
            $queryLimit .= 'LIMIT '. $page * $rowPerPages;
            if ($rowPerPages !== NULL) {
                $queryLimit .= ", $rowPerPages";
            }
        }

        $stmt = DBConnection::getPDO()->prepare("SELECT N_SIREN as siren, Raison_Sociale as raisonSociale, 
            datetr as date, count(datetr) as nombreTransactions, 'Euro', moyenPay, sum(Mtrans) as montantTotal 
            FROM {$table} NATURAL JOIN {$entrepriseTable} WHERE idCompte = :id GROUP BY datetr, N_SIREN {$queryCondition} 
            ORDER BY {$orderBy} {$orderdirection} {$queryLimit}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute($where);
        return $stmt->fetchAll();
    }

    public static function getInfosCount(int $idCompte): int {
        $table = static::getTable();

        $stmt = DBConnection::getPDO()->prepare("SELECT 1 FROM {$table} WHERE idCompte = ? GROUP BY datetr, N_SIREN");
        $stmt->execute([$idCompte]);
        return $stmt->rowCount();
    }

    public static function getTransactions(int $idCompte, int $siren, string $date, string $orderBy='datetr', string $orderdirection='DESC', array $where=[], int $page=NULL, int $rowPerPages=NULL): array {
        $table = static::getTable();
        $entrepriseTable = Entreprise::getTable();

        $queryCondition = implode(' and ', array_map(function($condition) {
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

        $where['idCompte'] = $idCompte;
        $where['siren'] = $siren;
        $where['datetr'] = $date;

        $stmt = DBConnection::getPDO()->prepare("SELECT N_SIREN as siren, Raison_Sociale as raisonSociale, 
            datetr as datetr, 'Euro', moyenPay, Mtrans as montant
            FROM {$table} NATURAL JOIN {$entrepriseTable} WHERE idCompte = :idCompte AND N_SIREN = :siren AND 
            datetr = :datetr GROUP BY datetr, N_SIREN {$queryCondition} ORDER BY {$orderBy} {$orderdirection} {$queryLimit}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute($where);
        return $stmt->fetchAll();
    }

    public static function getTransactionsCount(int $idCompte, int $siren, string $date): int {
        $table = static::getTable();

        $stmt = DBConnection::getPDO()->prepare("SELECT 1 FROM {$table} 
            WHERE idCompte = ? AND N_SIREN = ? AND datetr = ? GROUP BY datetr, N_SIREN");
        $stmt->execute([$idCompte, $siren, $date]);
        return $stmt->rowCount();
    }
}