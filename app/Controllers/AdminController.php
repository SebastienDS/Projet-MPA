<?php


namespace App\Controllers;


class AdminController extends Controller {

    public function accueil() {
        $this->isConnected('admin');
    }
}