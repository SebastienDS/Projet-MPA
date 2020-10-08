<?php

use Router\Router;

require 'vendor/autoload.php';

define('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);

$fullUrl = $_SERVER['PHP_SELF'];
$prefix = $_SERVER['SCRIPT_NAME'];

$url = substr($fullUrl, strlen($prefix));


$router = new Router($url);

$router->get('/', 'App\Controllers\AccueilController@index');
$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->get('/test/:id', 'App\Controllers\AccueilController@test');


$router->post('/connexion', 'App\Controllers\ConnexionController@validConnexion');


$router->run();
