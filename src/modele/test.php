<?php

include 'AdherentBD.php';

$test = array("bob", "test", 2, "test@mail.com", "qwe", 12, "2024-01-12", "dk");

$adherent1 = new Adherent();

$adherent1->nom = "bob";
$adherent1->prenom = "test$";
$adherent1->id_ville = 2;
$adherent1->mail = "test@mail.com";
$adherent1->password = "123";
$adherent1->points = 12;
$adherent1->date_creation = "2024-01-12";
$adherent1->compte = "dk";

AdherentBD::addAdherent($adherent1);

$liste = AdherentBD::getAdherent();

?>
