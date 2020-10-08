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

    public function connected() {
        return $this->view('connected/showInfo', [
            'title' => 'Connecté',
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ]);
    }

    public function validConnexion() {
        if ($_POST['username'] === 'test' && $_POST['password'] === 'test') {
            return $this->connected();
        }
        return $this->connexion();
    }
}