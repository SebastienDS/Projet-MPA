<?php


namespace App\Controllers;


class ClientController extends Controller {
    public function accueil() {
        $this->isConnected('client');

        return $this->view('connected/client/accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
            ]
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