<?php

require ('./controleur/config.php');
require ("./modele/FilmBD.php");

$test = FilmBD::getFilms(DB_FILM_TABLE);

echo '<pre>';
print_r($test);
echo '</pre>';


?>
