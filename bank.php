<?php

use Router\Router;

require 'vendor/autoload.php';

define('SCRIPT_NAME', str_replace('/bank.php', '', $_SERVER['SCRIPT_NAME']));

$fullUrl = $_SERVER['PHP_SELF'];
$prefix = $_SERVER['SCRIPT_NAME'];

$url = substr($fullUrl, strlen($prefix));


$router = new Router($url);

$router->get('/', 'App\Controllers\AccueilController@index');

$router->get('/client', 'App\Controllers\ClientController@accueil');
$router->get('/client/showInfo', 'App\Controllers\ClientController@showInfo');
$router->get('/client/changePassword', 'App\Controllers\ConnexionController@changePassword');
$router->post('/client/password/validation', 'App\Controllers\ConnexionController@passwordValidation');
$router->get('/client/logout', 'App\Controllers\ConnexionController@logout');

$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->post('/connexion/validation', 'App\Controllers\ConnexionController@validConnexion');

$router->get('/test/:id', 'App\Controllers\AccueilController@test');


$router->run();
