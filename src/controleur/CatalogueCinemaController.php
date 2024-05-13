<?php

class CatalogueCinemaController extends Controller
{

    // Classes PDO utilisées
    private FilmBD    $filmBD;

    // Variables utilisées par la vue
    private array     $allFilmsDispo;

    // Variables utilisées par le controller

    public function __construct()
    {

        $this->titre    = 'Catalogue cinéma';
        $this->view     = 'catalogueCinema';

        $this->filmBD = new FilmBD();
        $this->allFilmsDispo = $this->filmBD->selectFilmsDispo();


        $this->data = array(
            'titre' => $this->titre,
            'allFilmsDispo' => $this->allFilmsDispo,
        );

        $this->render($this->view, $this->data);
    }
}
