<?php

class AdherentCompteController extends Controller
{

    // Classes PDO utilisées
    private AdherentBD $adherentBD;

    // Variables utilisées par la vue
    private Adherent $adherent;

    // Variables utilisées par le controller
    private string    $requestMethod;

    public function __construct(string $requestMethod)
    {
        if (isset($_SESSION['current_adherent'])) {
            $this->adherent = $_SESSION['current_adherent'];
        } else {
            Router::redirect('accueil');
            die();
        }

        $this->requestMethod = $requestMethod;
        $this->titre    = 'Mon Compte';
        $this->view     = 'adherentCompte';

        if ($this->requestMethod === 'POST') {
            $this->adherentBD = new AdherentBD();
            self::handlePosts($this->adherentBD);
        }

        $this->data = array(
            'titre'      => $this->titre,
            'adherent'   => $this->adherent
        );

        $this->render($this->view, $this->data);
    }

    private static function handlePosts(AdherentBD $adherentBD)
    {
        $adhToMod = $adherentBD->selectById($_SESSION['current_adherent']->id);

        if (!isset($_POST['supp-compte-check'])) {

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
            $adherentBD->update($adhToMod);
            $_SESSION['current_adherent'] = $adhToMod;
        } else {
            $adherentBD->delete($adhToMod->id);
            session_destroy();
        }

        header('Refresh:0');
    }
}
