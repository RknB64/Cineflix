<?php

require ('./controleur/config.php');
require ("./modele/FilmBD.php");

$testGet = FilmBD::getFilms(DB_FILM_TABLE);
$titre = 'John Wick';
$desc = 'Un homme d\'une extrême concentration';
$dateExpir = '2025-01-01 13:14:09';
$dateSortie = '2024-01-01 13:14:09';
$duree = '2H00';
$idAffiche = 2;
$etat = 'streaming';
$testCreate = FilmBD::addFilm(DB_FILM_TABLE, $titre, $desc, $dateExpir, $dateSortie, $duree, $idAffiche, $etat);
$testGetAll = FilmBD::getFilms(DB_FILM_TABLE);
$testGetByTitle = FilmBD::getFilmByTitle(DB_FILM_TABLE, 'John Wick');

echo 'TEST 1 : Get tout les films';
echo '<pre>';
print_r($testGet);
echo '</pre>';

echo 'TEST 2 : Get tout les films après Create';
echo '<pre>';
print_r($testGetAll);
echo '</pre>';

echo 'TEST 3 : Get le film créé';
echo '<pre>';
print_r($testGetByTitle);
echo '</pre>';

?>
