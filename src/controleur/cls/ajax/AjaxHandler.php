<?php

class AjaxHandler
{

  // constante pour orienter les requêtes
  public const AUTOCOMPLETE_VILLE = "autocomplete-ville";

  public static function autocomplete(string $userInput, object $objectBD, string $colName) : ?array
  {
    $result = null;

    if ($userInput != "") {
      $result = $objectBD->selectLike($userInput, $colName, $colName, 6);

    }

    return $result;
  }
}
