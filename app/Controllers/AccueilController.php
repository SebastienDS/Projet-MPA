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
}
