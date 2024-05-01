<?php
ob_start();

require RACINE . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class PdfForm
{
    static function generateBillet($film, $cinema, $ville, $day, $dayNum, $month, $hour, $minute, $nbPlaces)
    {

        $myForm = '<h1>Merci pour votre achat !</h1>';
        $myForm .= '<h3>Résumé de la reservation</h3>';
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
        // <a href="data.php" target="_blank">télecharger</a>';

        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($myForm);
        ob_end_clean();
        $html2pdf->output();
    }
}
