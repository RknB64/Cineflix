<?php

require RACINE . '/vue/component/pdfForm.php';

$villeId = null;
$cinemaId = null;
$seanceId = null;
$nbPlaces = null;

if (/*isset($_SESSION['login']) &&*/isset($_POST)) {
    $villeId = $_POST['ville-select'];
    $cinemaId = $_POST['cinema-select'];
    $seanceId = $_POST['seance-select'];
    $nbPlaces = $_POST['place-select'];

    $vbd = new VilleBD();
    $villeNom = new Ville();
    $villeNom = ($vbd->selectById($villeId))->nom;

    $cbd = new CinemaBD();
    $cinemaNom = new Cinema();
    $cinemaNom = ($cbd->selectById($cinemaId))->nom;

    $sbd = new SeanceBD();
    $seance = new Seance();
    $seance = $sbd->selectById($seanceId);
    $seanceDate = $seance->horaire_date;

    $seanceTimestamp = strtotime($seanceDate);
    $seanceDateDetail = getdate($seanceTimestamp);

    $day = $seanceDateDetail['weekday'];
    $dayNum = $seanceDateDetail['mday'];
    $month = $seanceDateDetail['month'];
    $hour = $seanceDateDetail['hours'];
    $minute = $seanceDateDetail['minutes'];

    $fbd = new FilmBD();
    $film = new Film();
    $film = ($fbd->selectById($seance->id_film))->titre;

    pdfForm::generateBillet($film, $cinemaNom, $villeNom, $day, $dayNum, $month, $hour, $minute, $nbPlaces);
} else {
    echo 'pas de session';
}

// echo "<pre>";
// print_r($seanceDate);
// print_r($day);
// print_r($dayNum);
// print_r($month);
// print_r($hour);
// print_r($minute);
// die();
