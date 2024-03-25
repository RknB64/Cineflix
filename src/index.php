<?php

require dirname(__FILE__) . '/controleur/config.php';
require RACINE . '/cls/router.php';
require_once AUTOLOAD;

$action = null;

if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $fichier = Router::redirect($action);
   
} elseif (isset($_GET["ville"])) {
    // If 'ville' parameter is set, set the action to 'search'
    $action = 'search';
    $fichier = Router::redirect($action);
} elseif (isset($_GET["ville"])) {
    // If 'ville' parameter is set, set the action to 'search'
    $action = 'search';
} else {
    $fichier = 'accueil.controller.php';
}

require RACINE . "/controleur/" . $fichier;
