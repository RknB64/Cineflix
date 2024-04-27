<?php

class DetailFilmController extends Controller
{

    private FilmDetail $detailFilm;
    private array $villesAvecCinemas;

    public function __construct()
    {

        $this->titre    = 'detail film';
        $this->view     = 'detailFilm';

        // TODO 
        if (!isset($_GET['id'])) {
            return null;
        }

        $this->detailFilm = new FilmDetail($_GET["id"]);
        $this->villesAvecCinemas = $this->getVillesData();

        $this->data = array(
            'titre'               => $this->titre,
            'detailFilm'          => $this->detailFilm,
            'villesAvecCinemas'   => $this->villesAvecCinemas,
        );

        $this->render($this->view, $this->data);
    }

    private function getVillesData(): array
    {

        $data = [
            'seances' => $this->detailFilm->seances,
            'salles' => $this->detailFilm->salles,
            'cinemas' => $this->detailFilm->cinemas,
            'villes' => $this->detailFilm->villes
        ];

        // Créer un tableau vide pour stocker les villes avec les cinémas
        $villesAvecCinemas = [];

        // Associer les cinémas à leurs villes respectives
        foreach ($data['villes'] as $ville) {
            $ville->cinemas = [];
            foreach ($data['cinemas'] as $cinema) {
                if ($cinema->id_ville === $ville->id) {
                    $ville->cinemas[] = $cinema;
                }
            }
            $villesAvecCinemas[] = $ville;
        }

        // Associer les séances à leurs cinémas et salles respectifs dans chaque ville
        foreach ($villesAvecCinemas as $ville) {
            foreach ($ville->cinemas as $cinema) {
                $cinema->seances = [];
                foreach ($data['seances'] as $seance) {
                    foreach ($data['salles'] as $salle) {
                        if ($seance->id_salle === $salle->id && $salle->id_cinema === $cinema->id) {
                            $cinema->seances[] = $seance;
                        }
                    }
                }
            }
        }

        // Supprimer les doublons de séances
        foreach ($this->detailFilm->cinemas as $cinema) {
            foreach ($cinema->seances as $seance) {
                if (!isset($seancesUniques[$seance->id])) {
                    $seancesUniques[$seance->id] = $seance;
                }
            }
            $cinema->seances = array_values($seancesUniques);
        }

        return $villesAvecCinemas;
    }
}
