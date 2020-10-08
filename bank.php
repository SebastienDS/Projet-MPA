<?php

use Router\Router;

require 'vendor/autoload.php';

define('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);

$fullUrl = $_SERVER['REQUEST_URI'];
$prefix = $_SERVER['SCRIPT_NAME'];

$url = substr($fullUrl, strlen($prefix));


$router = new Router($url);

$router->get('/', 'App\Controllers\AccueilController@index');
$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->get('/test/:id', 'App\Controllers\AccueilController@test');

$router->run();