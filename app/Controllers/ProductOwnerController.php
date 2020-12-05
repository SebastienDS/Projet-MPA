<?php


namespace App\Controllers;


use App\Models\Compte;
use App\Models\Profil;
use App\Models\Transaction;

class ProductOwnerController extends Controller {

    public function accueil() {
        $this->isConnected(['productOwner']);


        if (isset($_GET['search']) && Profil::exist($_GET['search'])) {
            $comptes = [Profil::findById($_GET['search'], ['id', 'nom', 'prenom'])];
        } else {
            $comptes = Profil::getColumns(['id', 'nom', 'prenom']);
        }

        return $this->view('productOwner/accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'comptes' => $comptes
        ]);
    }

    public function client(int $id) {
        $this->isConnected(['productOwner']);

        $client = Profil::findById($id, ['nom', 'prenom']);
        $comptes = Compte::getInfos($id);

        return $this->view('productOwner/comptesClient', [
            'title' => 'Comptes client',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'idClient' => $id,
            'client' => $client,
            'comptes' => $comptes
        ]);
    }

    public function compte(int $idClient, int $idCompte) {
        $this->isConnected(['productOwner']);

        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'datetr'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'DESC'; }

        $transactions = Transaction::getInfos($idCompte, $_GET['colSorted'], $_GET['sortDirection'], $where);
        $compteInfos = Compte::findById($idCompte, ['solde']);

        return $this->view('productOwner/detailCompte', [
            'title' => 'Detail compte',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'idClient' => $idClient,
            'numeroCompte' => $idCompte,
            'transactions' => $transactions,
            'compteInfos' => $compteInfos
        ]);
    }

    public function transactions(int $idClient, int $idCompte, int $siren, string $date) {
        $this->isConnected(['productOwner']);

        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'datetr'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'DESC'; }

        $transactions = Transaction::getTransactions($idCompte, $siren, $date, $_GET['colSorted'], $_GET['sortDirection'], $where);
        $compteInfos = Compte::findById($idCompte, ['solde']);

        return $this->view('productOwner/detailTransaction', [
            'title' => 'Detail transaction',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'idClient' => $idClient,
            'numeroCompte' => $idCompte,
            'transactions' => $transactions,
            'compteInfos' => $compteInfos,
            'siren' => $siren,
            'date' => $date
        ]);
    }

    public function impayes(int $idClient) {
        $this->isConnected(['productOwner']);

        $dates = Transaction::getDates();
        $dateDebut = htmlentities($_GET['dateDebut'] ?? $dates[0]->datetr);
        $dateFin = htmlentities($_GET['dateFin'] ?? end($dates)->datetr);

        $impayes = Transaction::getImpayes($dateDebut, $dateFin, $idClient);
        foreach ($impayes as $key => $row) {
            for ($i = 1; $i < count($row); $i++) {
                $impayes[$key][$i] = (int)$row[$i];
            }
        }
        array_unshift($impayes, ['Mois', 'Impayés CB', 'Impayés Visa', 'Impayés Mastercard']);


        return $this->view('productOwner/impayesClient', [
            'title' => 'impayés client',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'idClient' => $idClient,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'impayes' => $impayes
        ]);
    }
}