<?php


namespace App\Models;


class Transaction extends Model {

    protected static $table = 'Transaction';

    public static function getTable(): string {
        return self::$table;
    }
}