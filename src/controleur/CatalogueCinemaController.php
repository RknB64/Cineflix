<?php

class CatalogueCinemaController extends Controller
{

    private FilmBD    $filmBD;
    private array     $allFilmsDispo;

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
