<?php

// inputs qui seront affichés
$fields = UserRegister::getFields();

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
