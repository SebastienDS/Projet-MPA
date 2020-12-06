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
$router->get('/client/compte/:id/transaction/:siren/:date', 'App\Controllers\CompteController@detailTransaction');


$router->get('/admin', 'App\Controllers\AdminController@accueil');
$router->get('/admin/ajoutProfil', 'App\Controllers\AdminController@ajoutProfil');
$router->post('/admin/ajoutProfil', 'App\Controllers\AdminController@creationProfil');
$router->post('/admin/deleteProfil/:id', 'App\Controllers\AdminController@deleteProfil');
$router->get('/admin/updateProfil/:id', 'App\Controllers\AdminController@updateProfil');
$router->post('/admin/updateProfil/:id', 'App\Controllers\AdminController@updateProfilPOST');
$router->get('/admin/updateProfil/:id/modificationCompte', 'App\Controllers\AdminController@listComptes');
$router->get('/admin/updateProfil/:id/ajoutCompte', 'App\Controllers\AdminController@ajoutCompte');
$router->post('/admin/updateProfil/:id/ajoutCompte', 'App\Controllers\AdminController@ajoutComptePOST');
$router->get('/admin/updateProfil/:idClient/deleteCompte/:idCompte', 'App\Controllers\AdminController@deleteCompte');


$router->get('/productOwner', 'App\Controllers\ProductOwnerController@accueil');
$router->get('/productOwner/impayes', 'App\Controllers\ProductOwnerController@impayes');
$router->get('/productOwner/client/:id', 'App\Controllers\ProductOwnerController@client');
$router->get('/productOwner/client/:id/compte/:idCompte', 'App\Controllers\ProductOwnerController@compte');
$router->get('/productOwner/client/:id/impayes', 'App\Controllers\ProductOwnerController@impayesClient');
$router->get('/productOwner/client/:idClient/compte/:idCompte/transaction/:siren/:date', 'App\Controllers\ProductOwnerController@transactions');



$router->post('/download/:format/compte/:id', 'App\Controllers\DownloadController@downloadCompte');
$router->post('/download/:format/impayes/client/:idClient', 'App\Controllers\DownloadController@downloadImpayesClient');
$router->post('/download/:format/compte/:id/transaction/:siren/:date', 'App\Controllers\DownloadController@downloadTransaction');
$router->post('/download/:format/impayes', 'App\Controllers\DownloadController@downloadImpayesPO');



$router->run();