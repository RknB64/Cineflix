<?php
session_start();

class Router
{

    public static function redirect($action, $requestMethod = '')
    {
        switch ($action) {

            case 'accueil':
                new AccueilController();
                break;

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

            case 'achat':
                new AchatController();
                break;

            case 'connexion':
                new ConnexionController();
                break;

            case 'logout':
                new LogoutController();
                break;

            case 'recherche':
                new RechercheController();
                break;

            case 'compte':
                new AdherentCompteController($requestMethod);
                break;

            case 'admin':
                new AdminController();
                break;

            default:
                new Page404Controller();
                break;
        }
    }
}
