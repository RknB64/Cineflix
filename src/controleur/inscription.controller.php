<?php

$fields = [
    //  label                           type            name
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

    $email = isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $mail = isset($_POST['mail']) ? $_POST['mail'] : "";
    $ville = isset($_POST['ville']) ? $_POST['ville'] : "";
    $mdp = isset($_POST['password']) ? $_POST['password'] : "";
    $mdp_check = isset($_POST['password_check']) ? $_POST['password_check'] : "";

    echo strcmp($mdp, $mdp_check);
}
