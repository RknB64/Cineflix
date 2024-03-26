<?php

function redirect($action) {

/* echo $action; */
switch ($action) {

	case 'accueil':
		$fichier = "accueil.controller.php";
		break;

	case 'signIn':
		$fichier = "inscription.controller.php";
		break;

	case 'page1':
		$fichier = "page1_ctl.php";
		break;
	case 'stream':
		$fichier = 'StreamController.php';
		break;
	case'search':
		$fichier = 'searchController.php';
		break;
	case 'showfilm':
		$fichier = 'accueil.controller.php';
		break;
	default:
		$fichier = "page404_ctl.php";
		break;
}

	if(! file_exists(RACINE . '/controleur/'. $fichier) ) die("Le fichier : " . $fichier . " n'existe pas !");

	return $fichier;
}

?>
