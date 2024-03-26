<?php

require RACINE . '/modele/MyPdo.php';
require RACINE . '/modele/AdherentBD.php';
require RACINE . '/modele/cls/UserManager.php';

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
    UserManager::handleRegisterPost($_POST);
}


function handlePost()
{
    $adBD = new AdherentBD();
    $ad = new Adherent();

    handleInput($ad);

    $mdp = isset($_POST['password']) ? $_POST['password'] : "";
    $mdp_check = isset($_POST['password_check']) ? $_POST['password_check'] : "";

    $hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $valid_mdp = password_verify($mdp_check, $hash_mdp);

    if ($valid_mdp) {
        $ad->password = $hash_mdp;
        $isAdded = $adBD->add($ad);
    } else {
        echo "no";
    }
}

function handleInput(Adherent $ad): void
{
    $nom    = isset($_POST['nom'])      ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom'])   ? $_POST['prenom'] : "";
    $mail   = isset($_POST['mail'])     ? $_POST['mail'] : "";
    $ville  = isset($_POST['ville'])    ? $_POST['ville'] : "";

    $ad->nom        = Utilities::sanitaze($nom);
    $ad->prenom     = Utilities::sanitaze($prenom);
    $ad->mail       = Utilities::sanitaze($mail);
    $ad->id_ville   = Utilities::sanitaze($ville);
}
