<?php

include 'MyPdo.php';
include 'AdherentBD.php';
include 'SalleBD.php';
include 'SeanceBD.php';

$t = new AdherentBD();

/* $sbd = new SeanceBD(); */

/* $x = $t->getById(1); */


$ad = new Adherent();

$ad->nom = "bob";
$ad->prenom = "test";

$arr = $t->selectAll();

echo var_dump($arr);



$sa = new SalleBD();

$newSalle = new Salle;

$newSalle->nb_place = 8;
$newSalle->id_cinema = 3;
$newSalle->nb_place

$sa->add($newSalle);

$vileBd = new VilleBD();


?>
