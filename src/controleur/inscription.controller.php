<?php

require RACINE . '/modele/MyPdo.php';
require RACINE . '/modele/AdherentBD.php';

// inputs qui seront affichés
$fields = [
    //  label                       type            name
    ["Nom",                         "text",         "nom"],
    ["Prénom",                      "text",         "prenom"],
    ["Email",                       "email",        "mail"],
    ["Ville",                       "text",         "ville"],
    ["Mot de passe",                "password",     "password"],
    ["Retaper le mot de passe",     "password",     "password_check"]
];

// défini des constantes pour simplifier l'acces, par exemple: $fields[0][LABEL]
define("LABEL", 0);
define("TYPE", 1);
define("NAME", 2);

include './vue/header.html.php';
include './vue/inscription.vue.php';
include './vue/footer.html.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "post";
    handlePost();
}


function handlePost()
{
    $adBD = new AdherentBD();
    $ad = new Adherent();

    $ad->nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $ad->prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $ad->mail = isset($_POST['mail']) ? $_POST['mail'] : "";
    $ad->id_ville = isset($_POST['ville']) ? $_POST['ville'] : "";
    $ad->points = 0;
    $ad->date_creation = date('Y-m-d H:i:s');
    $ad->compte = "ad";

    $mdp = isset($_POST['password']) ? $_POST['password'] : "";
    $mdp_check = isset($_POST['password_check']) ? $_POST['password_check'] : "";

    $hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $valid_mdp = password_verify($mdp_check, $hash_mdp);

    if ($valid_mdp) {
        $ad->password = $hash_mdp;
    } else {
        echo "no";
    }

    $adBD->add($ad);
}
