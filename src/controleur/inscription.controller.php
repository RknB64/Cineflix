<?php

// inputs qui seront affichés
$formFields = UserRegister::getFormFields();

include './vue/header.html.php';
include './vue/inscription.vue.php';
include './vue/footer.html.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  UserRegister::handleRegisterPost($_POST);

}
