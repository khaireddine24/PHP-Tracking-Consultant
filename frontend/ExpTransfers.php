<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include_once('../database/config.php');
include_once('../controllers/TransferController.php');
$transferController = new TransferController();
$transfers = $transferController->transferList();


$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Transferts</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Liste des Transferts</h1>
    <table>
        <thead>
            <tr>
                <th>Consultant</th>
                <th>Transfer Type</th>
                <th>Beneficiary</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>';

foreach ($transfers as $transfer) {
    $html .= '<tr>
                <td>' . $transfer['first_name'] . ' ' . $transfer['last_name'] . '</td>
                <td>' . $transfer['transfer_type'] . '</td>
                <td>' . $transfer['beneficiary'] . '</td>
                <td>' . $transfer['amount'] . '</td>
            </tr>';
}

$html .= '</tbody>
    </table>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->render();
$pdfFileName = 'liste_transferts_' . date('Y-m-d') . '.pdf';
$dompdf->stream($pdfFileName, array('Attachment' => 0));
