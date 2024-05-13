<?php

class AccueilController extends Controller
{

    // Classes PDO utilisées
    private FilmBD $filmBD;

    // Variables utilisées par la vue
    private array $allFilmsDispo;
    private array $filmsDispo;

    // Variables utilisées par le controller

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
