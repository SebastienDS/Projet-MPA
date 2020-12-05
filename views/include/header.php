<?php 

if (!isset($_SESSION['auth'])) {
    require_once('views/include/headerAccueil.php');
}
else if ($_SESSION['auth'] === 'client') {
    require_once('views/include/headerClient.php');
}
else if ($_SESSION['auth'] === 'admin') {
    require_once('views/include/headerAdmin.php');
}
else if ($_SESSION['auth'] === 'productOwner') {
    require_once('views/include/headerPO.php');
}