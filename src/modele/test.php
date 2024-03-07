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

$arr = $t->selectWhere($ad);

echo var_dump($arr);

?>
