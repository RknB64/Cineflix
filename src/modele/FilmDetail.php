<?php

class FilmDetail
{
    public int    $id;
    public string $titre;
    public string $description;
    public string $duree;
    public int    $id_affiche;
    public string $date_sortie;
    public string $date_expiration;
    public array  $seances;
    public array  $salles;
    public array  $cinemas;
    public array  $villes;

    public function __construct(string $idQuery)
    {
        $id = intval($idQuery);
        $filmbd = new FilmBD();
        $detailFilm = new Film();
        $detailFilm = $filmbd->selectById($id);
        $this->id = $id;
        $this->titre = $detailFilm->titre;
        $this->description = $detailFilm->description;
        $this->duree = $detailFilm->duree;
        $this->id_affiche = $detailFilm->id_affiche;
        $this->date_sortie = $detailFilm->date_sortie;
        $this->date_expiration = $detailFilm->date_expiration;


        $seancebd = new SeanceBD();
        $seances = new Seance();
        $seances->id_film = $id;
        $seances = $seancebd->selectWhere($seances);
        $this->seances = $seances;


        $idSalles = array_column($this->seances, 'id_salle');

        $this->salles = array();
        $idCinema = array();
        $sallebd = new SalleBD();
        $salles = new Salle();
        foreach ($idSalles as $key => $idSalle) {
            $salles = $sallebd->selectById($idSalle);
            array_push($this->salles, $salles);
            array_push($idCinema, $salles->id_cinema);
        }

        $idCinemaClean = array_unique($idCinema);
        $this->cinemas = array();
        $cinemabd = new CinemaBD();
        $cinemas = new Cinema();
        foreach ($idCinemaClean as $key => $idCine) {
            $cinemas = $cinemabd->selectById($idCine);
            array_push($this->cinemas, $cinemas);
        }


        $villeIds = array();
        foreach ($this->cinemas as $key => $cinema) {
            array_push($villeIds, $cinema->id_ville);
        }
        $villeIdsClean = array_unique($villeIds);
        $this->villes = array();
        $villebd = new VilleBD();
        $villes = new Ville();
        foreach ($villeIdsClean as $key => $villeId) {
            $villes = $villebd->selectById($villeId);
            array_push($this->villes, $villes);
        }
    }
}
