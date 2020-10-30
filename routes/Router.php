<?php

namespace Router;

class Router {

    private $url;
    private $routes = [];


    public function __construct($url) {
        $this->url = trim($url, '/');
    }

    public function get(string $path, string $action) {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function post(string $path, string $action) {
        $this->routes['POST'][] = new Route($path, $action);
    }

    public function run() {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }

        header('HTTP/1.0 404 Not Found');
        return header('Location: '. SCRIPT_NAME . '/bank.php/404');
    }
}