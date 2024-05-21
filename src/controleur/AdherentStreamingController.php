<?php

class AdherentStreamingController extends Controller
{

    // Classes PDO utilisées
    private AdherentBD  $adherentBD;
    private StreamBD    $streamBD;

    // Variables utilisées par la vue
    private array       $adherentFilms;
    private bool        $filmBought = false;

    // Variables utilisées par le controller
    private Adherent   $adherent;
    private array      $adherentStream;
    private string     $requestMethod;

    public function __construct($requestMethod)
    {

        if (CurrentUser::isLoggedIn()) {
            $this->adherent = CurrentUser::getAdherent();
        } else {
            Router::redirect('page404');
            die();
        }

        $this->requestMethod = $requestMethod;
        $this->titre    = 'Mes films';
        $this->view     = 'adherentStream';


        if ($this->requestMethod === 'POST') {
            $this->adherentBD = new AdherentBD();
            self::handlePost($this->adherentBD);
        }

        $this->streamBD = new StreamBD();
        $adherentStream = $this->streamBD->selectAdherentFilmsStreaming($this->adherent);
        $this->adherentStream = array();
        if ($adherentStream !== null) $this->adherentStream = $adherentStream;
        $filmBD = new FilmBD();
        $this->adherentFilms = array();
        if ($this->adherentStream !== array()) {
            $this->filmBought = true;
            foreach ($this->adherentStream as $key => $stream) {
                $filmId = $stream->id_film;
                array_push($this->adherentFilms, $filmBD->selectById($filmId));
            }
        }

        // cree une array avec les variables que la vue utilisera
        $this->data = array(
            'titre'           => $this->titre,
            'adherentStream'  => $this->adherentStream,
            'filmBought'      => $this->filmBought,
            'adherentFilms'   => $this->adherentFilms
        );

        $this->render($this->view, $this->data);
    }

    private static function handlePost(AdherentBD $adherentBD)
    {
        $adhToMod = $adherentBD->selectById(CurrentUser::getId());

        if (isset($_POST['id-stream'])) {

            $streamBD = new StreamBD();
            $stream = new Stream();

            $dateAchat = date('Y-m-d H:i:s');
            $dateExp = date("Y-m-d H:i:s", strtotime('+15 days'));
            $stream->date_achat = $dateAchat;
            $stream->date_expiration = $dateExp;
            $stream->id_film = $_POST['id-stream'];
            $stream->id_adherent = CurrentUser::getId();

            $streamBD->add($stream);

            $adhToMod->points -= 15;
            $adherentBD->update($adhToMod);
            CurrentUser::updateAdherent($adhToMod);
        }
    }
}
