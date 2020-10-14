<?php


namespace App\Controllers;


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
        if ($_POST['username'] === 'test' && $_POST['password'] === 'test') {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['auth'] = 'client';
            return header('Location: '. SCRIPT_NAME .'/bank.php/client');

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