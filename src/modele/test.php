<?php

include 'MyPdo.php';
include 'AdherentBD.php';
include 'SalleBD.php';
include 'SeanceBD.php';

$t = new AdherentBD();

/* $sbd = new SeanceBD(); */

/* $x = $t->getById(1); */


$ad = new Adherent();


$ad = $t->getById(1);

echo $ad->nom;
echo var_dump($ad);

?>
