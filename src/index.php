<?php

require dirname(__FILE__) . '/controleur/config.php';
require_once AUTOLOAD;

$action = null;

if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $fichier = Router::redirect($action);
   
} else {
  new AccueilController();
}
