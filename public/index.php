<?php 

use Router\Router;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . '/views');
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']));


$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\AccueilController@index');
$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->get('/test/:id', 'App\Controllers\AccueilController@test');

$router->run();