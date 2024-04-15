<?php

$fbd = new FilmBD();
$listeFilms = new Film();
$listeFilms = $fbd->selectAll();
$titre = 'Accueil';
include './vue/header.html.php';
include './vue/accueil.vue.php';
include './vue/footer.html.php';
