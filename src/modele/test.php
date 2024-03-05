<?php

include 'PDO.php';
include 'AdherentBD.php';
include 'SalleBD.php';
include 'SeanceBD.php';

$t = new Seance();

$t->id = 1;
$t->id_film = 1;
$t->id_salle = 5;
$t->horaire_date = "2024-03-22";

$sbd = new SeanceBD();

$sbd->update($t);

?>
