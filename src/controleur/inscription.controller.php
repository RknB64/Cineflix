<?php

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
define("TYPE",  1);
define("NAME",  2);

include './vue/header.html.php';
include './vue/inscription.vue.php';
include './vue/footer.html.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  UserRegister::handleRegisterPost($_POST);
}
