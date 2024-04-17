<?php

// autoload doit être chargé quand on utilise ajax
require_once "../controleur/config.php";
require_once AUTOLOAD;

$request = $_POST['request'];

switch ($request) {

  case AjaxHandler::AUTOCOMPLETE_VILLE:
    AjaxHandler::autocompleteVille($_POST['keyword']);
    break;

  default:
    // TODO
    break;
}
