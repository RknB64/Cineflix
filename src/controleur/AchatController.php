<?php

class AchatController extends Controller
{

    // Classes PDO utilisées
    private VilleBD     $villeBD;
    private FilmBD      $filmBD;
    private CinemaBD    $cinemaBD;
    private SeanceBD    $seanceBD;

    // Variables utilisées par la vue
    private string $villeNom;
    private string $cinemaNom;
    private string $seanceDate;

    // Variables utilisées par le controller
    private int $villeId;
    private int $cinemaId;
    private int $seanceId;
    private int $nbPlaces;

    public function __construct()
    {

        $this->titre    = 'Achat';
        $this->view     = '';

        // cree une array avec les variables que la vue utilisera
        $this->data = array(
            'titre'           => $this->titre,
        );

        /* $this->render($this->view, $this->data); */

        if (isset($_POST)) {
            $this->villeId  = $_POST['ville-select'];
            $this->cinemaId = $_POST['cinema-select'];
            $this->seanceId = $_POST['seance-select'];
            $this->nbPlaces = $_POST['place-select'];

            $this->villeBD = new VilleBD();
            $this->villeNom = ($this->villeBD->selectById($this->villeId))->nom;

            $this->cinemaBD = new CinemaBD();
            $this->cinemaNom = ($this->cinemaBD->selectById($this->cinemaId))->nom;

            $this->seanceBD = new SeanceBD();
            $seance = $this->seanceBD->selectById($this->seanceId);
            $this->seanceDate = $seance->horaire_date;


            $seanceTimestamp    = strtotime($this->seanceDate);
            $seanceDateDetail   = getdate($seanceTimestamp);

            $day    = $seanceDateDetail['weekday'];
            $dayNum = $seanceDateDetail['mday'];
            $month  = $seanceDateDetail['month'];
            $hour   = $seanceDateDetail['hours'];
            $minute = $seanceDateDetail['minutes'];

            $this->filmBD = new FilmBD();
            $film = new Film();
            $film = ($this->filmBD->selectById($seance->id_film))->titre;

            PdfForm::generateBillet($film, $this->cinemaNom, $this->villeNom, $day, $dayNum, $month, $hour, $minute, $this->nbPlaces);
        } else {
            echo 'pas de session';
        }
    }
}
