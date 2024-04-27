<?php

class Router
{

    public static function redirect($action, $requestMethod = '')

    {

        switch ($action) {

            case 'catalogue':
                new CatalogueCinemaController();
                break;

            case 'streaming':
                new StreamingController();
                break;

            case 'signIn':
                new InscriptionController($requestMethod);
                break;

            case 'film-details':
                new DetailFilmController();
                break;

            case 'ajax':
                new AjaxRequestController();
                break;

            case 'search':
                new RechercheController();
                break;

            default:
                new Page404Controller();
                break;
        }
    }
}
