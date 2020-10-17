<?php


namespace App\Models;


class Transaction extends Model {

    protected static $table = 'transaction';

    public static function getTable(): string {
        return self::$table;
    }
}