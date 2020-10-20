<?php


namespace App\Controllers;

use App\Models\Client;
use App\Models\Admin;
use App\Models\Profil;

class ConnexionController extends Controller {

    public function connexion() {
        $error = (int)htmlentities($_GET['error'] ?? 0);

        return $this->view('connexion', [
            'title' => 'Connectez-vous',
            'style' => [
                'accueil',
                'style',
                'connexion'
            ],
            'error' => $error
        ]);
    }

    public function validConnexion() {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $_SESSION['username'] = $username;

        if (Client::isConnected($username, $password)) {
            $_SESSION['auth'] = 'client';
            return header('Location: '. SCRIPT_NAME .'/bank.php/client?success=1');
        }
        if (Admin::isConnected($username, $password)) {
            $_SESSION['auth'] = 'admin';
            return header('Location: '. SCRIPT_NAME .'/bank.php/admin?success=1');
        }
        return header('Location: '. SCRIPT_NAME .'/bank.php/connexion?error=1');
    }

    public function changePassword() {
        $this->isConnected('client');

        $error = (int)htmlentities($_GET['error'] ?? 0);

        return $this->view('client/changePassword', [
            'title' => 'Changer Mot de passe',
            'style' => [
                'accueil',
                'style',
                'connexion',
            ],
            'error' => $error
        ]);
    }

    public function passwordValidation() {
        $this->isConnected('client');

        $newPassword = htmlentities($_POST['newPassword']);
        $newPasswordConfirm = htmlentities($_POST['newPasswordConfirm']);
        $lastPassword = htmlentities($_POST['lastPassword']);

        if ($newPassword !== $newPasswordConfirm) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/client/changePassword?error=1');
        }
        if ($newPassword === $lastPassword) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/client/changePassword?error=2');
        }

        $updatedRows = Profil::updatePassword($_SESSION['username'], $lastPassword, $newPassword);
        if (!$updatedRows) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/client/changePassword?error=3');
        }
        return header('Location: '. SCRIPT_NAME .'/bank.php/client?success=2');
    }

    public function logout() {
        session_destroy();
        return header('Location: '. SCRIPT_NAME .'/bank.php');
    }
}