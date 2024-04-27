<?php

class Page404Controller extends Controller
{

    public function __construct()
    {
        $this->titre    = 'Page introuvable';
        $this->view     = 'page404';

        $this->data = array(
            'titre' => $this->titre
        );

        $this->render($this->view, $this->data);
    }
}
