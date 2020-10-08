<?php

namespace App\Controllers;

class AccueilController extends Controller {

    public function index() {
        return $this->view('accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }

    public function test(int $id) {
        header('Location: ../connexion');
        return $this->view('test', [
            'title' => 'Test',
            'id' => $id,
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }
}
