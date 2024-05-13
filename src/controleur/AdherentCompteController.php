<?php

class AdherentCompteController extends Controller
{

    // Classes PDO utilisées
    private AdherentBD $adhBd;
    private Adherent $adherent;
    private VilleBD $vbd;
    private Ville $ville;


    // Variables utilisées par la vue

    // Variables utilisées par le controller
    private string    $requestMethod;

    public function __construct(string $requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->titre    = 'Mon Compte';
        $this->view     = 'adherentCompte';


        $this->adhBd = new AdherentBD();
        $this->adherent = new Adherent();
        $this->adherent = $this->adhBd->selectById(3);

        $this->vbd = new VilleBD();
        $this->ville = new Ville();
        $this->ville = $this->vbd->selectById($this->adherent->id_ville);

        if ($this->requestMethod === 'POST') {
            $this->handlePosts();
        }

        $this->data = array(
            'titre'      => $this->titre,
            'adherent'   => $this->adherent
        );

        $this->render($this->view, $this->data);
    }



    private function handlePosts()
    {

        if (isset($_POST['confirm']) && isset($_POST['compte-mod-nom'])) {
            $this->adherent->nom = Utilities::sanitaze($_POST['compte-mod-nom']);
            $this->adhBd->update($this->adherent);
        }

        if (isset($_POST['compte-mod-prenom'])) {
            $this->adherent->prenom = Utilities::sanitaze($_POST['compte-mod-prenom']);
            $this->adhBd->update($this->adherent);
        }

        if (isset($_POST['compte-mod-mail']) && !UserManager::isEmailInBD($_POST['compte-mod-mail']) && filter_var($_POST['compte-mod-mail'], FILTER_VALIDATE_EMAIL)) {
            $this->adherent->mail = Utilities::sanitaze($_POST['compte-mod-mail']);
            $this->adhBd->update($this->adherent);
        }

        if (isset($_POST['compte-mod-mdp']) && isset($_POST['compte-conf-mdp']) && $_POST['compte-mod-mdp'] === $_POST['compte-conf-mdp']) {
            $this->adherent->password = password_hash(Utilities::sanitaze($_POST['compte-mod-mdp']), PASSWORD_DEFAULT);
            $this->adhBd->update($this->adherent);
        }
    }
}


// $titre = 'Mon Compte';
// include './vue/header.html.php';
// include './vue/adherentCompte.vue.php';
// include './vue/footer.html.php';

// echo '<pre>';
// print_r($adherent);
// // Adherent Object
// // (
// //     [id] => 3
// //     [nom] => Bob
// //     [prenom] => Marley
// //     [mail] => bo@mail.com
// //     [id_ville] => 1
// //     [password] => $2y$10$hpODrIItalNtKBnQE13jHOnGdSsRof19QyWoUJjNRlvJK7t4UeVYm
// //     newPassword => $2y$10$QBkGBg6x.cNbUspWCg6zEer0H2i9PE7uI7fpta2sB5w...
// //     [points] => 40
// //     [date_creation] => 2024-04-15 09:45:36
// //     [estAdmin] => 0
// // )
// die();


?>

<!-- <script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault(); // Empêche le rechargement de la page
            $('#staticBackdrop').modal('show'); // Affiche le modal de confirmation
        });

        $('#confirmForm').submit(function(e) {
            e.preventDefault(); // Empêche la soumission du formulaire

            // Récupère les données du formulaire
            let formData = $('#myForm').serialize();

            $.ajax({
                url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', // Utilisez le nom du fichier PHP actuel comme URL
                method: 'POST',
                data: formData, // Données à envoyer
                success: function(response) {
                    // Gérer la réponse du serveur si nécessaire
                    console.log(response);
                    // Vous pouvez ajouter ici un code pour actualiser la page ou afficher un message de succès
                },
                error: function(xhr, status, error) {
                    // Gérer les erreurs de la requête AJAX si nécessaire
                    console.error(xhr, status, error);
                }
            });

            $('#staticBackdrop').modal('hide'); // Cache le modal de confirmation
        });
    });
</script> -->