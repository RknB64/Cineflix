<?php

class NameController extends Controller
{

    // En 1er : Classes PDO utilisées par le controller
    private CinemaBD    $cinemaBD;
    private FilmBD      $filmBD;

    // En 2eme : Variable qui seront utilisées par la vue
    private ?array      $results;
    private string      $villeName;

    // En 3eme : Variable utilisées uniquement par le controller
    private int         $villeId;
    private int         $cinemaId;

    public function __construct()
    {
        $this->titre    = 'Titre de la page';
        $this->view     = 'nom de la vue sans le .php';

        // ajouter toutes les variables qui seront utilisées dans la vue dans cette array.
        // !! la clef doit être le nom de la variable comme dans la vue
        $this->data = array(
            'titre'     => $this->titre,
            'results'   => $this->results,
        );

        // on peut aussi ajouter des valeurs dans $data comme ça
        $this->data['villeName'] = $this->villeName;

        // render la vue à la fin du controller en utilisant 'view' et 'data' (data est optionnel)
        $this->render($this->view, $this->data);
    }
}
