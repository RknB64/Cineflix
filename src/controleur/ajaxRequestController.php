<?php

// autoload doit être chargé quand on utilise ajax
require_once "../controleur/config.php";
require_once AUTOLOAD;

$request = $_POST['request'];

switch ($request) {

  case AjaxHandler::AUTOCOMPLETE_VILLE:
    $villeDao = new VilleBD();
    $colName = 'nom';
    $userInput = $_POST['keyword'];

    $result = AjaxHandler::autocomplete($_POST['keyword'], $villeDao, $colName);
    include(RACINE . '/vue/component/ajaxCompletionList.php');
    break;

  default:
    // TODO
    break;
}
