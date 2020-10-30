<?php


namespace App\Controllers;


class AdminController extends Controller {

    public function accueil() {
        $this->isConnected(['admin']);

        return $this->view('admin/accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
                'comptes',
                'modal'
            ]
        ]);
    }

    public function ajoutCompte() {
        $this->isConnected(['admin']);

        $this->view('admin/ajoutCompte', [
            'title' => 'Ajout Compte',
            'style' => [
                'accueil',
                'style',
                'comptes',
            ]
        ]);
    }

    public function creationCompte() {
        $this->isConnected(['admin']);

        
        return var_dump($_POST);
    }

    public function deleteCompte(int $id) {

    }
}