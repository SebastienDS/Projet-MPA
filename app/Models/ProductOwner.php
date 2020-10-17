<?php


namespace App\Models;


class ProductOwner extends Model {

    protected static $table = 'PO';

    public static function getTable(): string {
        return self::$table;
    }
}