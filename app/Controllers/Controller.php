<?php


namespace App\Controllers;


use Database\DBConnection;

class Controller {

    private $db;

    public function __construct(DBConnection $db) {
        $this->db = $db;
    }

    public function getDB(): DBConnection {
        return $this->db;
    }

    public function view(string $path, array $params = []) {
        extract($params);

        ob_start();
        require "views/$path.php";
        $content = ob_get_clean();

        return require "views/layout/layout.php";
    }
}