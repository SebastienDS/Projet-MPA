<?php


namespace App\Controllers;


use App\Models\Profil;

class AdminController extends Controller {

    public function accueil() {
        $this->isConnected(['admin']);


        if (isset($_GET['search'])) {
            $comptes = [Profil::findById($_GET['search'], ['id', 'nom', 'prenom'])];
            //error bad id
        } else {
            $comptes = Profil::getColumns(['id', 'nom', 'prenom']);
        }

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

        return $this->view('admin/ajoutCompte', [
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

        $infos = array_filter($_POST);
        if (count($infos) !== count($_POST)) return header('Location: '. SCRIPT_NAME .'/bank.php/admin/ajoutCompte');
        $id = Profil::create($infos['nom'], $infos['prenom'], $infos['password']);
        return header('Location: '. SCRIPT_NAME ."/bank.php/admin/updateCompte/{$id}");
    }

    public function deleteCompte(int $id) {
        $this->isConnected(['admin']);

        Profil::delete($id);
    }

    public function updateCompte(int $id) {
        $this->isConnected(['admin']);

        $infos = Profil::findById($id, ['id', 'nom', 'prenom']);

        return $this->view('admin/updateCompte', [
            'title' => 'Update Compte',
            'style' => [
                'accueil',
                'style',
                'comptes',
            ],
            'infos' => $infos
        ]);
    }

    public function updateProfil(int $id) {
        $this->isConnected(['admin']);

        $infos = array_filter($_POST);
        if (count($infos) < 2) return header('Location: '. SCRIPT_NAME .'/bank.php/admin/ajoutCompte');
        Profil::update($id, $infos);
        return header('Location: '. SCRIPT_NAME .'/bank.php/admin');
    }
}