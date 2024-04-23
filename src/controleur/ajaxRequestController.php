<?php

$request = $_POST['request'];

switch ($request) {

  case AjaxHandler::AUTOCOMPLETE_VILLE:
    $villeDao = new VilleBD();
    $colName = 'nom';
    $userInput = $_POST['keyword'];
    $inputId = $_POST['inputId'];

    $result = AjaxHandler::autocomplete($_POST['keyword'], $villeDao, $colName);
    include(RACINE . '/vue/component/ajaxCompletionList.php');
    break;

  default:
    // TODO
    break;
}
