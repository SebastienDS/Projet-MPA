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
            // error with nombreTransactions and montantTotal
        }

        $transactions = Transaction::getInfos($id, 'date', 'DESC', $where);
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
}