<?php

class AccueilController extends Controller
{

    private FilmBD $filmBD;

    private array $allFilmsDispo;
    private array $filmsDispo;

    public function __construct()
    {

        $this->titre    = 'Accueil';
        $this->view     = 'accueil';

        $this->filmBD   = new FilmBD();

        $this->allFilmsDispo    = $this->filmBD->selectFilmsDispoAccueil();
        $this->filmsDispo       = array_slice($this->allFilmsDispo, 0, 2);

        // cree une array avec les variables que la vue utilisera
        $this->data = array(
            'titre'           => $this->titre,
            'allFilmsDispo'   => $this->allFilmsDispo,
            'filmsDispo'      => $this->filmsDispo
        );

        $this->render($this->view, $this->data);
    }
}
