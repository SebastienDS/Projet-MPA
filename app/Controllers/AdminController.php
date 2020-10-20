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
                'comptes'
            ]
        ]);
    }
}