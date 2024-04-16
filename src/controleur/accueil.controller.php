<?php

$fbd = new FilmBD();
$filmsDispo = new Film();
$filmsDispo = $fbd->selectFilmsDispo();

$titre = 'Accueil';
include './vue/header.html.php';
include './vue/accueil.vue.php';
include './vue/footer.html.php';
