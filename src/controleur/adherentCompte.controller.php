<?php

$adhBd = new AdherentBD();
$adherent = new Adherent();
$adherent = $adhBd->selectById(3);

$vbd = new VilleBD();
$ville = new Ville();
$ville = $vbd->selectById($adherent->id_ville);

if (isset($_POST['confirm']) && isset($_POST['compte-mod-nom'])) {
    $adherent->nom = Utilities::sanitaze($_POST['compte-mod-nom']);
    $adhBd->update($adherent);
}

if (isset($_POST['compte-mod-prenom'])) {
    $adherent->prenom = Utilities::sanitaze($_POST['compte-mod-prenom']);
    $adhBd->update($adherent);
}

if (isset($_POST['compte-mod-mail']) && !UserManager::isEmailInBD($_POST['compte-mod-mail']) && filter_var($_POST['compte-mod-mail'], FILTER_VALIDATE_EMAIL)) {
    $adherent->mail = Utilities::sanitaze($_POST['compte-mod-mail']);
    $adhBd->update($adherent);
}

if (isset($_POST['compte-mod-mdp']) && isset($_POST['compte-conf-mdp']) && $_POST['compte-mod-mdp'] === $_POST['compte-conf-mdp']) {
    $adherent->password = password_hash(Utilities::sanitaze($_POST['compte-mod-mdp']), PASSWORD_DEFAULT);
    $adhBd->update($adherent);
}

$titre = 'Mon Compte';
include './vue/header.html.php';
include './vue/adherentCompte.vue.php';
include './vue/footer.html.php';

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