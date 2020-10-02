<?php 

use Router\Router;

require '../../vendor/autoload.php';


$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\AccueilController@accueil');
$router->get('/test/:id', 'App\Controllers\AccueilController@test');

$router->run();