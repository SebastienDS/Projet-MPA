<?php

use Router\Router;

require 'vendor/autoload.php';

require 'database/dbParams.php';
define('SCRIPT_NAME', str_replace('/bank.php', '', $_SERVER['SCRIPT_NAME']));

$fullUrl = $_SERVER['PHP_SELF'];
$prefix = $_SERVER['SCRIPT_NAME'];

$url = substr($fullUrl, strlen($prefix));


$router = new Router($url);

$router->get('/', 'App\Controllers\AccueilController@index');

$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->post('/connexion/validation', 'App\Controllers\ConnexionController@validConnexion');
$router->get('/logout', 'App\Controllers\ConnexionController@logout');

$router->get('/client', 'App\Controllers\ClientController@accueil');
$router->get('/client/showInfo', 'App\Controllers\ClientController@showInfo');
$router->get('/client/changePassword', 'App\Controllers\ConnexionController@changePassword');
$router->post('/client/password/validation', 'App\Controllers\ConnexionController@passwordValidation');
$router->get('/client/mesComptes', 'App\Controllers\ClientController@mesComptes');
$router->get('/client/compte/:id', 'App\Controllers\CompteController@detail');
$router->get('/client/mesImpayes', 'App\Controllers\ClientController@mesImpayes');



$router->get('/admin', 'App\Controllers\AdminController@accueil');


$router->post('/client/download/pdf/compte/:id', 'App\Controllers\DownloadController@downloadPDF');
$router->post('/client/download/xls/compte/:id', 'App\Controllers\DownloadController@downloadXLS');
$router->post('/client/download/csv/compte/:id', 'App\Controllers\DownloadController@downloadCSV');


$router->run();