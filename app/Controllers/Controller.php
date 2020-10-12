<?php


namespace App\Controllers;


class Controller {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function view(string $path, array $params = []) {
        extract($params);

        ob_start();
        require "views/$path.php";
        $content = ob_get_clean();

        return require "views/layout/layout.php";
    }

    public function isConnected(string $auth) {
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] != $auth) {
            return header('Location: '. SCRIPT_NAME . '/bank.php/connexion');
        }
    }
}