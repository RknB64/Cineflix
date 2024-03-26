<?php

require dirname(__FILE__) . '/controleur/config.php';
require RACINE . '/cls/router.php';
require_once AUTOLOAD;

$action = null;

if (isset($_GET["action"])) {
	$action = $_GET["action"];
	$fichier = redirect($action);
} else {
	$fichier = 'accueil.controller.php';
}

require RACINE . "/controleur/" . $fichier;

?>
