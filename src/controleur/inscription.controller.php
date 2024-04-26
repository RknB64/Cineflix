<?php

// inputs qui seront affichés
$formFields = UserRegister::getFormFields();
$titre = 'Inscription';

include './vue/header.php';
include './vue/inscription.vue.php';
include './vue/footer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  UserRegister::handleRegisterPost($_POST);

}
