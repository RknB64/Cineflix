<?php

require dirname(__FILE__) . '/controleur/config.php';
require_once AUTOLOAD;

$requestMethod = $_SERVER['REQUEST_METHOD'];


$action = null;

if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $fichier = Router::redirect($action, $requestMethod);
   
} else {
  new AccueilController();
}
