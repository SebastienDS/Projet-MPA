<?php


namespace App\Controllers;


class ClientController extends Controller {
    public function accueil() {
        $this->isConnected('client');
        $success = (int)htmlentities($_GET['success'] ?? 0);

        return $this->view('connected/client/accueil', [
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
        
        return $this->view('connected/client/showInfo', [
            'title' => 'Connecté',
            'username' => $_SESSION['username'],
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }
}