<?php


namespace App\Controllers;

use App\Models\Client;
use App\Models\Admin;

class ConnexionController extends Controller {

    public function connexion() {
        return $this->view('connexion', [
            'title' => 'Connectez-vous',
            'style' => [
                'accueil',
                'style',
                'connexion'
            ]
        ]);
    }

    public function validConnexion() {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $_SESSION['username'] = $username;

        if ((new Client())->isConnected($username, $password)) {
            $_SESSION['auth'] = 'client';
            return header('Location: '. SCRIPT_NAME .'/bank.php/client');
        }
        if ((new Admin())->isConnected($username, $password)) {
            $_SESSION['auth'] = 'admin';
            return header('Location: '. SCRIPT_NAME .'/bank.php/admin');
        }
        return header('Location: '. SCRIPT_NAME .'/bank.php/connexion');
    }

    public function changePassword() {
        $this->isConnected('client');

        return $this->view('connected/client/changePassword', [
            'title' => 'Changer Mot de passe',
            'style' => [
                'accueil',
                'style',
                'connexion',
            ]
        ]);
    }

    public function passwordValidation() {
        $this->isConnected('client');

        if (($_POST['newPassword'] === $_POST['newPasswordConfirm']) && ($_POST['newPassword'] !== $_POST['lastPassword'])) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/client');
        }
        return header('Location: '. SCRIPT_NAME .'/bank.php/client/changePassword');
    }

    public function logout() {
        session_destroy();
        return header('Location: '. SCRIPT_NAME .'/bank.php');
    }
}