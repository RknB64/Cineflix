<?php


require_once './modele/FilmBD.php';
require_once './modele/StreamBD.php';
$listeFilms = FilmBD::getFilms(DB_FILM_TABLE);
// $listeStreams = StreamBD::getStreams(DB_STREAM_TABLES);
$stream = new StreamBD();
$listStream = $stream->selectAll(); 
$titre = 'Accueil';
include './vue/header.html.php';
include './vue/accueil.vue.php';
include './vue/footer.html.php';


?>