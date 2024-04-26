<?php

class Router
{

	public static function redirect($action, $requestMethod)

	{

		switch ($action) {

			case 'catalogue':
				break;

			case 'streaming':
				break;

			case 'signIn':
        new InscriptionController($requestMethod);
				break;

			case 'film-details':
        new DetailFilmController();
				break;

			case 'stream':
				break;

			case 'ajax':
        new AjaxRequestController();
				break;
                
      case 'search':
          break;

			default:
				break;
		}

	}
}
