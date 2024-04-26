<?php

$fbd = new FilmBD();
$allFilmsDispo = new Film();
$allFilmsDispo = $fbd->selectFilmsDispo();

$titre = 'Catalogue cinéma';
include './vue/header.php';
include './vue/catalogueCinema.vue.php';
include './vue/footer.php';
