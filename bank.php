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
$router->get('/404', 'App\Controllers\NotFoundController@notFound');

$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->post('/connexion/validation', 'App\Controllers\ConnexionController@validConnexion');
$router->get('/changePassword', 'App\Controllers\ConnexionController@changePassword');
$router->post('/password/validation', 'App\Controllers\ConnexionController@passwordValidation');
$router->get('/logout', 'App\Controllers\ConnexionController@logout');
$router->get('/showInfo', 'App\Controllers\AccueilController@showInfo');


$router->get('/client', 'App\Controllers\ClientController@accueil');
$router->get('/client/mesComptes', 'App\Controllers\ClientController@mesComptes');
$router->get('/client/compte/:id', 'App\Controllers\CompteController@detail');
$router->get('/client/mesImpayes', 'App\Controllers\ClientController@mesImpayes');
$router->get('/client/compte/:id/detailTransaction/:siren/:date', 'App\Controllers\CompteController@detailTransaction');


$router->get('/admin', 'App\Controllers\AdminController@accueil');
$router->get('/admin/ajoutCompte', 'App\Controllers\AdminController@ajoutCompte');
$router->post('/admin/ajoutCompte', 'App\Controllers\AdminController@creationCompte');
$router->post('/admin/deleteCompte/:id', 'App\Controllers\AdminController@deleteCompte');
$router->get('/admin/updateCompte/:id', 'App\Controllers\AdminController@updateCompte');
$router->post('/admin/updateCompte/:id', 'App\Controllers\AdminController@updateProfil');


$router->post('/client/download/pdf/compte/:id', 'App\Controllers\DownloadController@downloadComptePDF');
$router->post('/client/download/xls/compte/:id', 'App\Controllers\DownloadController@downloadCompteXLS');
$router->post('/client/download/csv/compte/:id', 'App\Controllers\DownloadController@downloadCompteCSV');
$router->post('/client/download/pdf/impayes', 'App\Controllers\DownloadController@downloadImpayesPDF');
$router->post('/client/download/xls/impayes', 'App\Controllers\DownloadController@downloadImpayesXLS');
$router->post('/client/download/csv/impayes', 'App\Controllers\DownloadController@downloadImpayesCSV');


$router->run();