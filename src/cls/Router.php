<?php

class Router
{

	public static function redirect($action)

	{

		switch ($action) {

			case 'catalogue':
				$fichier = 'catalogueCinema.controller.php';
				break;

			case 'streaming':
				$fichier = 'streaming.controller.php';
				break;

			case 'signIn':
				$fichier = "inscription.controller.php";
				break;

			case 'film-details':
				$fichier = "detailFilm.controller.php";
				break;

			case 'stream':
				$fichier = 'StreamController.php';
				break;

			case 'ajax':
				$fichier = 'ajaxRequestController.php';
				break;

			case 'achat':
				$fichier = 'achat.controller.php';
				break;

			case 'search':
				$fichier = 'searchController.php';
				break;

			default:
				$fichier = "page404_ctl.php";
				break;
		}

		if (!file_exists(RACINE . '/controleur/' . $fichier)) die("Le fichier : " . $fichier . " n'existe pas !");

		return $fichier;
	}
}
