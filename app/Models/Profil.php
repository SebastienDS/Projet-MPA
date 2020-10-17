<?php


namespace App\Models;


class Profil extends Model {

    protected static $table = 'profilmpa';

    public static function getTable(): string {
        return self::$table;
    }
}