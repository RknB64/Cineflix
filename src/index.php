<?php

$action = null;

require dirname(__FILE__) . '/controleur/config.php';
require dirname(__FILE__) . '/modele/DbConnect.php';
require dirname(__FILE__) . '/cls/router.php';

if (isset($_GET["action"])) {
	$action = $_GET["action"];
	$fichier = redirect($action);
} else {
	$fichier = 'accueil.controller.php';
}

require RACINE . "/controleur/" . $fichier;

?>
