<?php

include 'MyPdo.php';
include 'AdherentBD.php';
include 'SalleBD.php';
include 'SeanceBD.php';
include 'StreamBD.php';
include 'AchatBD.php';


// Adherent----------------

$t = new AdherentBD();

/* $sbd = new SeanceBD(); */

/* $x = $t->getById(1); */


$ad = new Adherent();

$ad->nom = "bob";
$ad->prenom = "test";

$arr = $t->selectAll();

echo var_dump($arr);

// salle--------------

$sa = new SalleBD();

$newSalle = new Salle;

$newSalle->nb_place = 8;
$newSalle->id_cinema = 3;
$newSalle->nb_place = 40;

$sa->add($newSalle);

$vileBd = new VilleBD();

// stream---------------

$st = new StreamBD();
$str = new Stream();
$str->id_film = 1 ; 


// Achat
$ac = new AchatBD();
$ach= new Achat();
$ach->id_billet = 1;
// etc



