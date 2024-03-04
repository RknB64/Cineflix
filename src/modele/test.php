<?php

include 'AdherentBD.php';

$ad = new AdherentBD();

$test = array("2");
$ad::addAdherent($test);

$liste = $ad::getAdherent();

$adherent1 = array();

/* var_dump($liste); */

?>
