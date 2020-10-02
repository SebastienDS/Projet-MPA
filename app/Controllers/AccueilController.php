<?php

namespace App\Controllers;

class AccueilController {

    public function accueil() {
        echo "je suis l'accueil";
    }

    public function test(int $id) {
        echo "je test l'id $id";
    }
}
