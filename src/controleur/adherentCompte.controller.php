<?php

$adhBd = new AdherentBD();
$adherent = new Adherent();
$adherent = $adhBd->selectById(3);

$vbd = new VilleBD();
$ville = new Ville();
$ville = $vbd->selectById($adherent->id_ville);

if (($adherent->points) < 15) {
    $adherent->points = 40;
    $adhBd->update($adherent);
}

$titre = 'Mon Compte';
include './vue/header.html.php';
include './vue/adherentCompte.vue.php';
include './vue/footer.html.php';

// echo '<pre>';
// print_r($adherent);
// // Adherent Object
// // (
// //     [id] => 3
// //     [nom] => Bob
// //     [prenom] => Marley
// //     [mail] => bo@mail.com
// //     [id_ville] => 1
// //     [password] => $2y$10$hpODrIItalNtKBnQE13jHOnGdSsRof19QyWoUJjNRlvJK7t4UeVYm
// //     [points] => 40
// //     [date_creation] => 2024-04-15 09:45:36
// //     [estAdmin] => 0
// // )
// die();
