<?php

class Router
{

	public static function redirect($action)
<<<<<<< HEAD


=======
>>>>>>> c079407 (master local)
	{

		switch ($action) {

			case 'signIn':
				$fichier = "inscription.controller.php";
				break;

			case 'film-details':
				$fichier = "detailFilm.controller.php";
				break;
			case 'stream':
				$fichier = 'StreamController.php';
				break;
			default:
				$fichier = "page404_ctl.php";
				break;
		}

		if (!file_exists(RACINE . '/controleur/' . $fichier)) die("Le fichier : " . $fichier . " n'existe pas !");

		return $fichier;
	}
}
