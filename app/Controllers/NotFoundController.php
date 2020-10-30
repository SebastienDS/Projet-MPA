<?php

namespace App\Controllers;

class NotFoundController extends Controller {

    public function notFound() {
        return $this->view('404', [
            'title' => '404 not found',
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }
}
