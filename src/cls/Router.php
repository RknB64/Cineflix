<?php

class Router
{

	public static function redirect($action)

	{

		switch ($action) {

			case 'catalogue':
				break;

			case 'streaming':
				break;

			case 'signIn':
				break;

			case 'film-details':
        new DetailFilmController();
				break;

			case 'stream':
				break;

			case 'ajax':
				break;
                
      case 'search':
          break;

			default:
				break;
		}

	}
}
