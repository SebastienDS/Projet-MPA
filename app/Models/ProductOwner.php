<?php


namespace App\Models;


class ProductOwner extends Model {

    protected static $table = 'po';

    public static function getTable(): string {
        return self::$table;
    }
}