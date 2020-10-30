<?php


namespace App\Controllers;


class DownloadController extends Controller {

    public function downloadComptePDF(int $id) {
        $this->isConnected(['client']);

        return $this->view('downloadCompte', [
            'title' => 'Téléchargement PDF',
            'type' => 'PDF',
            'numeroCompte' => $id,
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }

    public function downloadCompteXLS(int $id) {
        $this->isConnected(['client']);

        return $this->view('downloadCompte', [
            'title' => 'Téléchargement XLS',
            'type' => 'XLS',
            'numeroCompte' => $id,
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }

    public function downloadCompteCSV(int $id) {
        $this->isConnected(['client']);

        return $this->view('downloadCompte', [
            'title' => 'Téléchargement CSV',
            'type' => 'CSV',
            'numeroCompte' => $id,
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }

    public function downloadImpayesPDF() {
        $this->isConnected(['client']);

        return $this->view('downloadImpayes', [
            'title' => 'Téléchargement PDF',
            'type' => 'PDF',
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }

    public function downloadImpayesXLS() {
        $this->isConnected(['client']);

        return $this->view('downloadImpayes', [
            'title' => 'Téléchargement XLS',
            'type' => 'XLS',
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }

    public function downloadImpayesCSV() {
        $this->isConnected(['client']);

        return $this->view('downloadImpayes', [
            'title' => 'Téléchargement CSV',
            'type' => 'CSV',
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }
}