<?php

namespace App\Controllers;

class AccueilController extends Controller {

    public function index() {
        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }

    public function showInfo() {
        $this->isConnected(['client', 'admin']);

        return $this->view('showInfo', [
            'title' => 'Connecté',
            'username' => $_SESSION['username'],
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }
}
