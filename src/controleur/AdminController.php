
<?php

// Note : Les modifications sur les films et les adhérents sur cette vue sont réalisés avex ajax par le fichier ajaxAdminOperation.js
class AdminController extends Controller
{

    // Classes PDO utilisées
    private FilmBD      $filmBD;
    private StreamBD    $streamBD;
    private AchatBD     $achatBD;
    private AdherentBD  $adherentBD;

    // Variables utilisées par la vue
    protected array $data;
    protected $table;

    // Variables utilisées par le controller

    public function __construct()
    {

        if (!CurrentUser::isLoggedIn() || !CurrentUser::isAdmin()) {
            Router::redirect('accueil');
            die();
        }

        $this->titre    = 'Administration';
        $this->view     = 'admin';

        $this->filmBD       = new FilmBD();
        $this->streamBD     = new StreamBD();
        $this->achatBD      = new AchatBD();
        $this->adherentBD   = new AdherentBD();

        $this->table = isset($_GET['table']) ? $_GET['table'] : 'admin';


        // Load the data based on the selected table
        switch ($this->table) {
            case 'stream':
                $this->data = $this->streamBD->selectAll();
                break;
            case 'achat':
                $this->data = $this->achatBD->selectAll();
                break;
            case 'adherent':
                $this->data = $this->adherentBD->selectAll();
                break;
            default:
                $this->data = $this->filmBD->selectAll();
                break;
        }


        // cree une array avec les variables que la vue utilisera
        $this->data = array(
            'titre' => $this->titre,
            'data'  => $this->data,
            'table' => $this->table,
        );

        $this->render($this->view, $this->data);
    }
}
