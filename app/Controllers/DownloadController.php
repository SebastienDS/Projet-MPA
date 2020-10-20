<?php


namespace App\Controllers;


class DownloadController extends Controller {

    public function downloadComptePDF(int $id) {
        $this->isConnected(['client']);

        return $this->view('downloadCompte', [
            'title' => 'Téléchargement PDF',
            'type' => 'PDF',
            'numeroCompte' => $id
        ]);
    }

    public function downloadCompteXLS(int $id) {
        $this->isConnected(['client']);

        return $this->view('downloadCompte', [
            'title' => 'Téléchargement XLS',
            'type' => 'XLS',
            'numeroCompte' => $id
        ]);
    }

    public function downloadCompteCSV(int $id) {
        $this->isConnected(['client']);

        return $this->view('downloadCompte', [
            'title' => 'Téléchargement CSV',
            'type' => 'CSV',
            'numeroCompte' => $id
        ]);
    }

    public function downloadImpayesPDF() {
        $this->isConnected(['client']);

        return $this->view('downloadImpayes', [
            'title' => 'Téléchargement PDF',
            'type' => 'PDF'
        ]);
    }

    public function downloadImpayesXLS() {
        $this->isConnected(['client']);

        return $this->view('downloadImpayes', [
            'title' => 'Téléchargement XLS',
            'type' => 'XLS'
        ]);
    }

    public function downloadImpayesCSV() {
        $this->isConnected(['client']);

        return $this->view('downloadImpayes', [
            'title' => 'Téléchargement CSV',
            'type' => 'CSV'
        ]);
    }
}