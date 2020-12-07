<?php


namespace App\Controllers;


use App\Models\Entreprise;
use App\Models\Profil;
use App\Models\Transaction;
use Mpdf\Mpdf;

class DownloadController extends Controller {

    public function downloadCompte(string $format, int $idCompte) {
        $idClient = (int)$_GET['idClient'];

        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'datetr'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'DESC'; }

        $data = Transaction::getInfos($idCompte, $_GET['colSorted'], $_GET['sortDirection'], $where);
        array_unshift($data, ['Numéro de SIREN', 'Raison Sociale', 'Date traitement', 'Nombre de Transactions', 'Devise', 'Moyen de paiement', 'Montant']);

        $params = [];
        if ($format === 'pdf') {
            $entreprise = Profil::getEntreprise($idClient);
            $params[] = "Exportation Compte n°$idCompte de $entreprise";
        }

        $download = 'download'. strtoupper($format);
        $this->$download($data, ...$params);
    }

    public function downloadImpayesClient(string $format, int $idClient) {
        $dateDebut = htmlentities($_GET['dateDebut']);
        $dateFin = htmlentities($_GET['dateFin']);

        $impayes = Transaction::getImpayes($dateDebut, $dateFin, $idClient);
        array_unshift($impayes, ['Mois', 'Impayés CB', 'Impayés Visa', 'Impayés Mastercard']);

        $params = [];
        if ($format === 'pdf') {
            $img = $_POST['imgStored'];
            $entreprise = Profil::getEntreprise($idClient);
            $params[] = "Exportation des impayés de $entreprise entre le $dateDebut et le $dateFin";
            return $this->downloadImagePDF($img, ...$params);
        }

        $download = 'download'. strtoupper($format);
        $this->$download($impayes, ...$params);
    }

    public function downloadTransaction(string $format, int $idCompte, int $siren, string $date) {
        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'datetr'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'DESC'; }

        $transactions = Transaction::getTransactions($idCompte, $siren, $date, $_GET['colSorted'], $_GET['sortDirection'], $where);
        array_unshift($transactions, ['Numéro de SIREN', 'Raison Sociale', 'Date traitement', 'Devise', 'Moyen de paiement', 'Montant']);

        $params = [];
        if ($format === 'pdf') {
            $params[] = "Exportation des Transactions du compte n°$idCompte";
        }

        $download = 'download'. strtoupper($format);
        $this->$download($transactions, ...$params);
    }

    public function downloadImpayesPO(string $format) {
        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'N_SIREN'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'ASC'; }

        $impayes = Entreprise::getImpayes($_GET['colSorted'], $_GET['sortDirection'], $where);
        array_unshift($impayes, ['Numéro de SIREN', 'Raison Sociale', 'Impayés']);

        $params = [];
        if ($format === 'pdf') {
            $params[] = "Exportation des impayés";
        }

        $download = 'download'. strtoupper($format);
        $this->$download($impayes, ...$params);
    }


    public function downloadPDF(array $data, string $title) {
        $content = '<table><tr>';
        foreach ((array)$data[0] as $key) {
            $content .= "<th> $key </th>";
        }
        $content .= "</tr>";

        foreach (array_slice($data, 1) as $row) {
            $content .= '<tr>';
            foreach ($row as $value) {
                $content .= "<td> {$value} </td>";
            }
            $content .= '</tr>';
        }
        $content .= '</table>';

        $pdf = new Mpdf();
        $pdf->WriteHTML(file_get_contents('public/css/download.css'), 1);
        $pdf->WriteHTML("<h1 class='title'> $title </h1>");
        $pdf->WriteHTML("<p class='title'>". date("F j, Y, g:i a") ."<p/>");
        $pdf->WriteHTML($content);
        $pdf->Output();
    }

    public function downloadImagePDF($img, string $title) {
        $pdf = new Mpdf();
        $pdf->WriteHTML(file_get_contents('public/css/download.css'), 1);
        $pdf->WriteHTML("<h1 class='title'> $title </h1>");
        $pdf->WriteHTML("<p class='title'>". date("F j, Y, g:i a") ."<p/>");
        $pdf->WriteHTML("<img src='$img'>");
        $pdf->Output();
    }

    public function downloadXLS(array $data) {
        $filename = 'export.xls';
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=$filename");

        $output = fopen('php://output', 'w');
        foreach ($data as $row) {
            fputcsv($output, (array)$row);
        }
        fclose($output);
    }

    public function downloadCSV(array $data) {
        $filename = 'export.csv';
        header('Content-type: text/csv');
        header("Content-Disposition: attachment; filename=$filename");

        $output = fopen('php://output', 'w');
        foreach ($data as $row) {
            fputcsv($output, (array)$row);
        }
        fclose($output);
    }
}