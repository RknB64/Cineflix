<?php

class AjaxHandler
{

  public const AUTOCOMPLETE_VILLE = "autocomplete-name";

  public static function autocompleteVille(string $keyword)
  {
    $colName = 'nom';

    if ($keyword != "") {
      $villeDao = new VilleBD();
      $result = $villeDao->selectLike($keyword, $colName, $colName, 6);

        if (!empty($result)) {
          include(RACINE . '/vue/component/ajaxCompletionList.php');
        }
    }
  }
}
