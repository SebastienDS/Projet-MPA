<?php


namespace App\Controllers;


use App\Models\Transaction;

class CompteController extends Controller {

    public function detail(int $id) {
        $this->isConnected(['client']);

        $transactions = Transaction::getInfos($id);

        return $this->view('client/detailCompte', [
            'title' => 'Detail compte',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'numeroCompte' => $id,
            'transactions' => $transactions
        ]);
    }
}