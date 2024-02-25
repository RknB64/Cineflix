<?php


require_once './modele/FilmBD.php';
 
$listeFilms = FilmBD::getFilms(DB_FILM_TABLE);

$titre = 'Accueil';
include './vue/header.html.php';
include './vue/accueil.vue.php';
include './vue/footer.html.php';


?>