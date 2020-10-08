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

    public function client() {
        return $this->view('connected/client/accueil', [
            'title' => 'Accueil',
            'style' => [
                'accueil',
                'style',
            ]
        ]);
    }

    public function test(int $id) {
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
