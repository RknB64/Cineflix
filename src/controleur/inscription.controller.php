<?php

$fields = [
//  label                           type            name (comme dans la bd)
    ["Nom",                         "text",         "nom"           ],
    ["Prénom",                      "text",         "prenom"        ],
    ["Email",                       "email",        "mail"          ],
    ["Ville",                       "text",         "id_ville"      ],
    ["Mot de passe",                "password",     "password"      ],
    ["Retaper le mot de passe",     "password",     "password_check"]
];

// défini des constantes pour simplifier l'acces, par exemple: $fields[0][LABEL]
define("LABEL", 0);
define("TYPE", 1);
define("NAME", 2);
 
include './vue/header.html.php';
include './vue/inscription.vue.php';
include './vue/footer.html.php';
?>
