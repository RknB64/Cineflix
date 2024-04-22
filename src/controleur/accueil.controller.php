<?php

$fbd = new FilmBD();
$allFilmsDispo = new Film();
$allFilmsDispo = $fbd->selectFilmsDispoAccueil();

//Quand le catalogue sera plus fourni, on pourra afficher 5 films -> remplacer 2 par 5
$filmsDispo = array_slice($allFilmsDispo, 0, 2);
// echo '<pre>';
// var_dump($filmsDispo);
// die();

$titre = 'Accueil';
include './vue/header.html.php';
include './vue/accueil.vue.php';
include './vue/footer.html.php';
