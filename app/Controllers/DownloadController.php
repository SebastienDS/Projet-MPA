<?php


namespace App\Controllers;


class DownloadController extends Controller {

    public function downloadPDF(int $id) {
        return $this->view('download', [
            'title' => 'Téléchargement PDF',
            'type' => 'PDF',
            'numeroCompte' => $id
        ]);
    }

    public function downloadXLS(int $id) {
        return $this->view('download', [
            'title' => 'Téléchargement XLS',
            'type' => 'XLS',
            'numeroCompte' => $id
        ]);
    }

    public function downloadCSV(int $id) {
        return $this->view('download', [
            'title' => 'Téléchargement CSV',
            'type' => 'CSV',
            'numeroCompte' => $id
        ]);
    }
}