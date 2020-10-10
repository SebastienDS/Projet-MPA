<?php


namespace App\Controllers;


class ClientController extends Controller {
    public function accueil() {
        return $this->view('connected/client/accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }

    public function showInfo() {
        session_start();
        return $this->view('connected/client/showInfo', [
            'title' => 'Connecté',
            'username' => $_SESSION['username'],
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }

    public function changePassword() {
        return $this->view('connected/client/changePassword', [
            'title' => 'Changer Mot de passe',
            'style' => [
                'accueil',
                'style',
                'connexion',
            ]
        ]);
    }

    public function validConnexion() {
        if ($_POST['username'] === 'test' && $_POST['password'] === 'test') {
            // return $this->connected();
            session_start();
            $_SESSION['username'] = $_POST['username'];

            header('Location: /bank.php/client');
            return $this->accueil();

        }
        header('Location: connexion');
    }

    public function passwordValidation() {
        if (($_POST['newPassword'] === $_POST['newPasswordConfirm']) && ($_POST['newPassword'] !== $_POST['lastPassword'])) {
            header('Location: /bank.php/client');
            return $this->accueil();
        }
        header('Location: changePassword');
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /bank.php');
    }
}