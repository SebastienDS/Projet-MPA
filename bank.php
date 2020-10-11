<pre>
    <?php var_dump($_SERVER); die()?>
</pre>

<?php

use Router\Router;

require 'vendor/autoload.php';

define('SCRIPT_NAME', str_replace('/bank.php', '', $_SERVER['SCRIPT_NAME']));
define('USER', isset($_SERVER['PHP_AUTH_USER']) ? "/~{$_SERVER['PHP_AUTH_USER']}" : '');

$fullUrl = $_SERVER['PHP_SELF'];
$prefix = $_SERVER['SCRIPT_NAME'];

$url = substr($fullUrl, strlen($prefix));


$router = new Router($url);

$router->get('/', 'App\Controllers\AccueilController@index');

$router->get('/client', 'App\Controllers\ClientController@accueil');
$router->get('/client/showInfo', 'App\Controllers\ClientController@showInfo');
$router->get('/client/changePassword', 'App\Controllers\ClientController@changePassword');
$router->post('/client/passwordValidation', 'App\Controllers\ClientController@passwordValidation');
$router->get('/client/logout', 'App\Controllers\ClientController@logout');

$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->post('/connexionValidation', 'App\Controllers\ClientController@validConnexion');

$router->get('/test/:id', 'App\Controllers\AccueilController@test');


$router->run();
