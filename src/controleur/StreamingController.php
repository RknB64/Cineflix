<?php

class StreamingController extends Controller
{
    // Classes PDO utilisées
    private FilmBD $filmBD;

    // Variables utilisées par la vue
    private array $allFilmsStreaming;

    // Variables utilisées par le controller

    public function __construct()
    {
        $this->titre = 'Streaming';
        $this->view = 'streaming';

        $this->data = array(
            'titre' => $this->titre,
        );

        if (CurrentUser::isLoggedIn()) {
            $this->filmBD   = new FilmBD();
            $this->allFilmsStreaming    = $this->filmBD->selectFilmsStreaming();
            $this->data = array(
                'titre' => $this->titre,
                'allFilmsStreaming' => $this->allFilmsStreaming,
            );
        }

        $this->render($this->view, $this->data);
    }
}
