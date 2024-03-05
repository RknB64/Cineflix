<?php

include 'AdherentBD.php';
include 'SalleBD.php';

$adherent1 = new Adherent();

$adherent1->id = 2;
$adherent1->nom = "jean";
$adherent1->prenom = "test$";
$adherent1->id_ville = 2;
$adherent1->mail = "test@mail.com";
$adherent1->password = "123";
$adherent1->points = 12;
$adherent1->date_creation = "2024-01-12";
$adherent1->compte = "dk";

$t = new Salle();
$t->id_cinema = 2;
$t->nb_place = 2;

$s = new SalleBD();

$s::getAll();

/* AdherentBD::updateAdherent($adherent1); */

/* $liste = AdherentBD::getAdherent(); */

?>
