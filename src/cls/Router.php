<?php

class Router
{

    public static function redirect($action, $requestMethod = '')
    {

        switch ($action) {

            case 'catalogueCinema':
                new CatalogueCinemaController();
                break;

            case 'streaming':
                new StreamingController();
                break;

            case 'inscription':
                new InscriptionController($requestMethod);
                break;

            case 'detailFilm':
                new DetailFilmController();
                break;

            case 'ajaxRequest':
                new AjaxRequestController();
                break;

            case 'recherche':
                new RechercheController();
                break;

            default:
                new Page404Controller();
                break;
        }
    }
}
