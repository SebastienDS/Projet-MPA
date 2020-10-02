<?php


namespace App\Controllers;


class Controller {


    public function view(string $path, array $params = []) {
        extract($params);

        ob_start();
        require VIEWS . "/$path.php";
        $content = ob_get_clean();

        return require VIEWS . "/layout.php";
    }
}