<?php


$action = null;

require dirname(__FILE__) . '/controleur/config.php';
require dirname(__FILE__) . '/modele/DbConnect.php';
require dirname(__FILE__) . '/cls/router.php';

require dirname(__FILE__) . '/modele/test.php';

if (isset($_GET["action"])) {
	$action = $_GET["action"];
	$fichier = redirect($action);
} elseif (isset($_GET["table"])) {
	$table = $_GET["table"];
	$fichier = tableRedirect($table);

	$fichier = 'admin/ReadCtrl.php';
} else {

	$fichier = 'accueil.controller.php';
}

require RACINE . "/controleur/" . $fichier;



