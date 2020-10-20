<?php


namespace App\Controllers;


class CompteController extends Controller {

    public function detail(int $id) {
        $this->isConnected(['client']);

        return $this->view('client/detailCompte', [
            'title' => 'Detail compte',
            'style' => [
                'accueil',
                'style',
                'comptes'
            ],
            'numeroCompte' => $id
        ]);
    }
}