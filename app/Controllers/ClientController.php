<?php


namespace App\Controllers;


class ClientController extends Controller {
    public function accueil() {
        $this->isConnected('client');
        $success = (int)htmlentities($_GET['success'] ?? 0);

        return $this->view('client/accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
            ],
            'success' => $success
        ]);
    }

    public function showInfo() {
        $this->isConnected('client');
        
        return $this->view('client/showInfo', [
            'title' => 'Connecté',
            'username' => $_SESSION['username'],
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }

    public function mesComptes() {
        $this->isConnected('client');

        return $this->view('client/mesComptes', [
            'title' => 'Mes Comptes',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ]
        ]);
    }

    public function mesImpayes() {
        $this->isConnected('client');

        return $this->view('client/mesImpayes', [
            'title' => 'Mes impayés',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ]
        ]);
    }
}