<?php


namespace App\Controllers;


use App\Models\Compte;
use App\Models\Profil;

class AdminController extends Controller {

    public function accueil() {
        $this->isConnected(['admin']);


        if (isset($_GET['search']) && Profil::exist($_GET['search'])) {
            $comptes = [Profil::findById($_GET['search'], ['id', 'nom', 'prenom'])];
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

    public function ajoutProfil() {
        $this->isConnected(['admin']);

        return $this->view('admin/ajoutProfil', [
            'title' => 'Ajout Profil',
            'style' => [
                'accueil',
                'style',
                'comptes',
            ]
        ]);
    }

    public function creationProfil() {
        $this->isConnected(['admin']);

        $infos = array_filter($_POST);
        if (count($infos) !== count($_POST)) return header('Location: '. SCRIPT_NAME .'/bank.php/admin/ajoutProfil');
        $id = Profil::create($infos['nom'], $infos['prenom'], $infos['password']);
        return header('Location: '. SCRIPT_NAME ."/bank.php/admin/updateProfil/{$id}");
    }

    public function deleteProfil(int $id) {
        $this->isConnected(['admin']);

        Profil::delete($id);
        return header('Location: '. SCRIPT_NAME . '/bank.php/admin');
    }

    public function updateProfil(int $id) {
        $this->isConnected(['admin']);

        $infos = Profil::findById($id, ['id', 'nom', 'prenom']);

        return $this->view('admin/updateProfil', [
            'title' => 'Update Profil',
            'style' => [
                'accueil',
                'style',
                'comptes',
            ],
            'infos' => $infos
        ]);
    }

    public function updateProfilPOST(int $id) {
        $this->isConnected(['admin']);

        $infos = array_filter($_POST);
        if (count($infos) < 2) return header('Location: '. SCRIPT_NAME .'/bank.php/admin/updateProfil/'. $id);
        Profil::update($id, $infos);
        return header('Location: '. SCRIPT_NAME .'/bank.php/admin');
    }

    public function listComptes(int $idClient) {
        $this->isConnected(['admin']);

        $comptes = Compte::getInfos($idClient);

        return $this->view('admin/updateComptes', [
            'title' => 'Update Comptes',
            'style' => [
                'accueil',
                'style',
                'comptes',
            ],
            'idClient' => $idClient,
            'comptes' => $comptes
        ]);
    }

    public function ajoutCompte(int $idClient) {
        $this->isConnected(['admin']);


        return $this->view('admin/ajoutCompte', [
            'title' => 'Update Comptes',
            'style' => [
                'accueil',
                'style',
                'comptes',
            ],
            'idClient' => $idClient,
        ]);
    }

    public function ajoutComptePOST(int $idClient) {
        $this->isConnected(['admin']);

        $infos = array_filter($_POST);
        if (isset($infos['nomCompte'])) {
            Compte::create($idClient, $infos['nomCompte']);
        }
        return header('Location: '. SCRIPT_NAME ."/bank.php/admin/updateProfil/$idClient/modificationCompte");
    }

    public function deleteCompte(int $idClient, int $idCompte) {
        $this->isConnected(['admin']);

        Compte::delete($idCompte);
        return header('Location: '. SCRIPT_NAME ."/bank.php/admin/updateProfil/$idClient/modificationCompte");
    }
}