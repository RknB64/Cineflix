<?php

$listeFilms = FilmBD::getFilms(DB_FILM_TABLE);
$listeStreams = StreamBD::getStreams(DB_STREAM_TABLES);
$titre = 'Accueil';
include './vue/header.html.php';
include './vue/accueil.vue.php';
include './vue/footer.html.php';


?>
