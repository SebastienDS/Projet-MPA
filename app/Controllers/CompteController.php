<?php


namespace App\Controllers;


use App\Models\Compte;
use App\Models\Transaction;

class CompteController extends Controller {

    public function detail(int $id) {
        $this->isConnected(['client']);

        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'datetr'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'DESC'; }

        $transactions = Transaction::getInfos($id, $_GET['colSorted'], $_GET['sortDirection'], $where);
        $compteInfos = Compte::findById($id, ['solde']);

        return $this->view('client/detailCompte', [
            'title' => 'Detail compte',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'numeroCompte' => $id,
            'transactions' => $transactions,
            'compteInfos' => $compteInfos
        ]);
    }

    public function detailTransaction(int $id, int $siren, string $date) {
        $this->isConnected(['client']);

        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'datetr'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'DESC'; }

        $transactions = Transaction::getTransactions($id, $siren, $date, $_GET['colSorted'], $_GET['sortDirection'], $where);
        $compteInfos = Compte::findById($id, ['solde']);

        return $this->view('client/detailTransaction', [
            'title' => 'Detail transaction',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'numeroCompte' => $id,
            'transactions' => $transactions,
            'compteInfos' => $compteInfos,
            'siren' => $siren,
            'date' => $date
        ]);
    }
}