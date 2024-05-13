<?php

class AdherentCompteController extends Controller
{

    // Classes PDO utilisées

    // Variables utilisées par la vue
    private Adherent $adherent;

    // Variables utilisées par le controller
    private string    $requestMethod;

    public function __construct(string $requestMethod)
    {
        $this->getAdherent();

        $this->requestMethod = $requestMethod;
        $this->titre    = 'Mon Compte';
        $this->view     = 'adherentCompte';

        if ($this->requestMethod === 'POST') {
            self::handlePosts();
        }

        $this->data = array(
            'titre'      => $this->titre,
            'adherent'   => $this->adherent
        );

        $this->render($this->view, $this->data);
    }

    private function getAdherent()
    {
        if (isset($_SESSION['current_adherent'])) {
            $this->adherent = $_SESSION['current_adherent'];
            // echo '<pre>';
            // print_r($_SESSION);
            // print_r($_POST);
            // print_r($_GET);
            // print_r($_SERVER);
            // print_r($this->adherent);
            // die();
        } else {
            Router::redirect('page404');
        }
    }

    private static function handlePosts()
    {
        $adhBdToMod = new AdherentBD();
        $adhToMod = $adhBdToMod->selectById($_SESSION['current_adherent']->id);

        if (isset($_POST['compte-mod-nom'])) {
            $adhToMod->nom = Utilities::sanitaze($_POST['compte-mod-nom']);
        }

        if (isset($_POST['compte-mod-prenom'])) {
            $adhToMod->prenom = Utilities::sanitaze($_POST['compte-mod-prenom']);
        }

        if (isset($_POST['compte-mod-mail']) && !UserManager::isEmailInBD($_POST['compte-mod-mail']) && filter_var($_POST['compte-mod-mail'], FILTER_VALIDATE_EMAIL)) {
            $adhToMod->mail = Utilities::sanitaze($_POST['compte-mod-mail']);
        }

        if (isset($_POST['compte-mod-mdp']) && isset($_POST['compte-conf-mdp']) && $_POST['compte-mod-mdp'] === $_POST['compte-conf-mdp']) {
            $adhToMod->password = password_hash(Utilities::sanitaze($_POST['compte-mod-mdp']), PASSWORD_DEFAULT);
        }

        $adhBdToMod->update($adhToMod);
        $_SESSION['current_adherent'] = $adhToMod;

        header("Refresh:0");
    }
}
