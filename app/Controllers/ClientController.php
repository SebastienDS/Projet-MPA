<?php


namespace App\Controllers;


use App\Models\Profil;
use App\Models\Transaction;

class ClientController extends Controller {
    public function accueil() {
        $this->isConnected(['client']);
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

    public function mesComptes() {
        $this->isConnected(['client']);

        $client = Profil::findById($_SESSION['id'], ['nom', 'prenom']);

        return $this->view('client/mesComptes', [
            'title' => 'Mes Comptes',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'client' => $client
        ]);
    }

    public function mesImpayes() {
        $this->isConnected(['client']);

        $dates = Transaction::getDates();
        $dateDebut = htmlentities($_GET['dateDebut'] ?? $dates[0]->datetr);
        $dateFin = htmlentities($_GET['dateFin'] ?? end($dates)->datetr);

        $impayes = Transaction::getImpayes($dateDebut, $dateFin);
        foreach ($impayes as $key => $row) {
            for ($i = 1; $i < count($row); $i++) {
                $impayes[$key][$i] = (int)$row[$i];
            }
        }
        array_unshift($impayes, ['Mois', 'Impayés CB', 'Impayés Visa', 'Impayés Mastercard']);


        return $this->view('client/mesImpayes', [
            'title' => 'Mes impayés',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'impayes' => $impayes
        ]);
    }
}