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
}