<?php


namespace App\Controllers;


use App\Models\Profil;

class AdminController extends Controller {

    public function accueil() {
        $this->isConnected(['admin']);

        $comptes = Profil::getColumns(['nom', 'prenom']);

        return $this->view('admin/accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
                'comptes',
                'modal'
            ],
            'comptes' => $comptes
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