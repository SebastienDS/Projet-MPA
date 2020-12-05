<?php


namespace App\Controllers;

use App\Models\Client;
use App\Models\Admin;
use App\Models\Profil;

class ConnexionController extends Controller {

    public function connexion() {
        $this->redirectIfLogged();
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
            $_SESSION['id'] = Profil::getIdWhere(['pseudo' => $username, 'pwd' => sha1($password)]);
            return header('Location: '. SCRIPT_NAME .'/bank.php/client?success=1');
        }
        if (Admin::isConnected($username, $password)) {
            $_SESSION['auth'] = 'admin';
            return header('Location: '. SCRIPT_NAME .'/bank.php/admin?success=1');
        }
        return header('Location: '. SCRIPT_NAME .'/bank.php/connexion?error=1');
    }

    public function changePassword() {
        $this->isConnected(['client', 'admin']);

        $error = (int)htmlentities($_GET['error'] ?? 0);

        return $this->view('changePassword', [
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
        $this->isConnected(['client', 'admin']);

        $newPassword = htmlentities($_POST['newPassword']);
        $newPasswordConfirm = htmlentities($_POST['newPasswordConfirm']);
        $lastPassword = htmlentities($_POST['lastPassword']);

        if ($newPassword !== $newPasswordConfirm) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/changePassword?error=1');
        }
        if ($newPassword === $lastPassword) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/changePassword?error=2');
        }

        $updatedRows = Profil::updatePassword($_SESSION['username'], $lastPassword, $newPassword);
        if (!$updatedRows) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/changePassword?error=3');
        }
        return header('Location: '. SCRIPT_NAME .'/bank.php/'. $_SESSION['auth'] .'?success=2');
    }

    public function logout() {
        session_destroy();
        return header('Location: '. SCRIPT_NAME .'/bank.php');
    }

    public function redirectIfLogged() {
        if (isset($_SESSION['auth'])) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/'. $_SESSION['auth']);
        }
    }
}