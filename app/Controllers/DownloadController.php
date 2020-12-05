<?php


namespace App\Controllers;


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
        $params = [];
        if ($format === 'pdf') {
            $client = Profil::findById($idClient, ['prenom', 'nom']);
            $params[] = "Exportation Compte n°$idCompte de {$client->prenom} {$client->nom}";
        }

        $download = 'download'. strtoupper($format);
        $this->$download($data, ...$params);
    }

    public function downloadImpayes(string $format) {
        return $this->view('downloadImpayes', [
            'title' => "Téléchargement $format",
            'type' => $format,
            'style' => [
                'accueil',
                'style'
            ]
        ]);
    }

    public function downloadTransaction(string $format, int $id, int $siren, string $date) {
        $where = [];
        $_GET = array_filter($_GET);
        if (isset($_GET['searchingBy']) && isset($_GET['search'])) {
            $where[$_GET['searchingBy']] = $_GET['search'];
        }

        if (!isset($_GET['colSorted'])) { $_GET['colSorted'] = 'datetr'; }
        if (!isset($_GET['sortDirection'])) { $_GET['sortDirection'] = 'DESC'; }

        $data = Transaction::getTransactions($id, $siren, $date, $_GET['colSorted'], $_GET['sortDirection'], $where);

        $download = 'download'. strtoupper($format);
        $this->$download($data);
    }

    public function downloadPDF(array $data, string $title) {
        $content = '<table><tr>';
        foreach (array_keys((array)$data[0]) as $key) {
            $content .= "<th> $key </th>";
        }
        $content .= "</tr>";

        foreach ($data as $row) {
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

    public function downloadXLS(array $data) {
        $filename = 'export.xls';
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=$filename");

        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys((array)$data[0]));

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
        fputcsv($output, array_keys((array)$data[0]));

        foreach ($data as $row) {
            fputcsv($output, (array)$row);
        }
        fclose($output);
    }
}