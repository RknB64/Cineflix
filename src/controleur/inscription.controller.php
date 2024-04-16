<?php

$fields = [
//  label                           type            
    ["Nom",                         "text"],
    ["Prénom",                      "text"],
    ["Email",                       "email"],
    ["Ville",                       "text"],
    ["Date de naissance",           "date"],
    ["Mot de passe",                "password"],
    ["Retaper le mot de passe",     "password"]
];

// défini des constantes pour simplifier l'acces, par exemple: $fields[0][LABEL]
define("LABEL", 0);
define("TYPE", 1);
 
include './vue/header.html.php';
include './vue/inscription.vue.php';
include './vue/footer.html.php';
?>
