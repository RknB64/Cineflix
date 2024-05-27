<?php
ob_start();

require RACINE . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class PdfForm
{
    static function generateBillet($film, $cinema, $ville, $day, $dayNum, $month, $hour, $minute, $nbPlaces, $numeroBillet)
    {
        // Generate QR code
        $qrCode = new QrCode($numeroBillet);
        $qrCode->setSize(150);

        $writer = new PngWriter();
        $qrCodePath = RACINE . '/static/img/qrcode.png'; 

        $result = $writer->write($qrCode);
        $result->saveToFile($qrCodePath);

        $qrCodeBase64 = base64_encode(file_get_contents($qrCodePath));
        $qrCodeImage = '<img src="data:image/png;base64,' . $qrCodeBase64 . '" alt="QR Code">';

        
        $myForm = '<h1>Merci pour votre achat !</h1>';
        $myForm .= '<h3>Résumé de la reservation</h3>';
        $myForm .= 'Numero: ' . $numeroBillet;
        $myForm .= '<br /><br />';
        $myForm .= $nbPlaces . ' places pour :';
        $myForm .= '<br /><br />';
        $myForm .= 'Film : ' . $film;
        $myForm .= '<br /><br />';
        $myForm .= 'Cinéma : ' . $cinema;
        $myForm .= '<br /><br />';
        $myForm .= 'Ville : ' . $ville;
        $myForm .= '<br /><br />';
        $myForm .= 'Pour une séance le : ' . $day . ' ' . $dayNum . ' ' . $month;
        $myForm .= '<br />';
        $myForm .= 'à : ' . $hour . ':' . $minute;
        $myForm .= '<br /><hr />';
        $myForm .= '<h3>QR Code:</h3>';
        $myForm .= $qrCodeImage;
        $myForm .= '<br /><br />';

       
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($myForm);
        ob_end_clean();
        $html2pdf->output();
    }
}
