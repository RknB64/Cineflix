<?php

class RechercheController extends Controller
{

    // Classes PDO utilisées
    private CinemaBD    $cinemaBD;
    private FilmBD      $filmBD;

    // Variables utilisées par la vue
    private ?array      $results;
    private string      $villeName;

    // Variables utilisées par le controller
    private int         $villeId;
    private int         $cinemaId;

    public function __construct()
    {

        $this->titre    = "Recherche cinéma";
        $this->view     = 'recherche';

        $this->data = array(
            'titre' => $this->titre,
        );

        // l'utilisateur utilise la barre de recherche
        if (isset($_GET['ville_id'])) {

            $this->cinemaBD = new CinemaBD();

            $this->villeId      = intval($_GET['ville_id']);
            $this->villeName    = $_GET['ville'];
            $this->results      = $this->search($this->cinemaBD, $this->villeId);

            $this->data['results']      = $this->results;
            $this->data['villeName']    = $this->villeName;

            $this->render($this->view, $this->data);

        // l'utilisateur clique sur 'voir les films' d'un cinéma. Dans ce cas c'est une requête ajax (depuis la vue 'recherche.php')
        } elseif (isset($_GET['cinema'])) {

            $this->cinemaId = $_GET['cinema'];
            $this->filmBD   = new FilmBD();

            $this->getFilmsByCinemaId($this->filmBD, $this->cinemaId);
        }
    }

    private function search($cinemaBD, $villeId)
    {
        $cine = new Cinema();
        $cine->id_ville = $villeId;;

        return $cinemaBD->selectWhere($cine);
    }

    public function getFilmsByCinemaId($filmBD, $cinemaId)
    {

        $films = $filmBD->getFilmsByCinemaId($cinemaId);

        // encode les films pour être utilisés par la requête ajax
        if (!empty($films)) {
            echo json_encode($films);
        } else {
            echo json_encode(['error' => 'Aucun film disponible pour ce cinema']);
        }
    }
}
