<?php

include 'MyPdo.php';
include 'AdherentBD.php';
include 'SalleBD.php';
include 'SeanceBD.php';

$t = new AdherentBD();

/* $sbd = new SeanceBD(); */

$x = $t->getById(1);

echo "<pre>".var_dump($x)."</pre>";

$ad = new Adherent();

$ad->nom = "test";

$t->selectWhere($ad);

?>
