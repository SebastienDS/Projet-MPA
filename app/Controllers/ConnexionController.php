<?php


namespace App\Controllers;

use App\Models\Client;
use App\Models\Admin;
use App\Models\ProductOwner;
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
        $stayConnected = htmlentities($_POST['stayConnected']);

        if (isset($_COOKIE['connected'])) {
            $_SESSION = explode(';', $_COOKIE['connected']);
        }
        if ((int)($_COOKIE['errorConnexion'] ?? 0) >= 3) {
            return header('Location: '. SCRIPT_NAME . '/bank.php/connexion?error=2');
        }

        $_SESSION['username'] = $username;

        if (Client::isConnected($username, $password)) {
            $_SESSION['auth'] = 'client';
            $_SESSION['id'] = Profil::getIdWhere(['pseudo' => $username, 'pwd' => sha1($password)]);
            if ($stayConnected) {
                $this->setCookie('connected', 86400, $_SESSION);    // 1 day
            }
            return header('Location: '. SCRIPT_NAME .'/bank.php/client?success=1');
        }
        if (Admin::isConnected($username, $password)) {
            $_SESSION['auth'] = 'admin';
            if ($stayConnected) {
                $this->setCookie('connected', 43200, $_SESSION);    // 12 hours
            }
            return header('Location: '. SCRIPT_NAME .'/bank.php/admin');
        }
        if (ProductOwner::isConnected($username, $password)) {
            $_SESSION['auth'] = 'productOwner';
            if ($stayConnected) {
                $this->setCookie('connected', 86400, $_SESSION);    // 1 day
            }
            return header('Location: '. SCRIPT_NAME .'/bank.php/productOwner');
        }

        if (!isset($_COOKIE['errorConnexion'])) {
            $this->setCookie('errorConnexion', 3*60, [1]);
        } else {
            $errorConnexion = (int)$_COOKIE['errorConnexion'];
            $errorConnexion++;
            $this->setCookie('errorConnexion', 3*60, [$errorConnexion]);

            if ($errorConnexion >= 3) {
                return header('Location: '. SCRIPT_NAME . '/bank.php/connexion?error=2');
            }
        }

        return header('Location: '. SCRIPT_NAME .'/bank.php/connexion?error=1');
    }

    public function changePassword() {
        $this->isConnected(['client', 'admin', 'productOwner']);

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
        $this->isConnected(['client', 'admin', 'productOwner']);

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
        $this->setCookie('connected', -1);
        return header('Location: '. SCRIPT_NAME .'/bank.php');
    }

    public function redirectIfLogged() {
        if (isset($_SESSION['auth'])) {
            return header('Location: '. SCRIPT_NAME .'/bank.php/'. $_SESSION['auth']);
        }
    }

    public function setCookie(string $name, int $duration, array $params=[]) {
        setCookie($name, implode(';', $params), time() + $duration);
    }
}