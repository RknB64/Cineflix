<!-- <?php

        ?>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="?action=compte" id="confirmForm" method="post">
                <input type="hidden" name="confirm">
                <div class="modal-body" id="modal-body">
                    Voulez-vous continuer ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Confirmer</button>
                    <button type="btn" id="btnAnnuler" class="btn btn-primary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btnAnnuler').click(function(e) {
            e.preventDefault();
            $('#staticBackdrop').modal('hide');
        });
    });
</script> -->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- Contenu du modal -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- En-tête du modal -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Corps du modal -->
            <form action="?action=compte" id="confirmForm" method="post">
                <input type="hidden" name="confirm"> <!-- Champ caché pour indiquer la confirmation -->
                <div class="modal-body" id="modal-body">
                    Voulez-vous continuer ?
                </div>
                <!-- Pied du modal avec les boutons de confirmation -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Confirmer</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script JavaScript -->
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault(); // Empêcher la soumission du formulaire
            $('#staticBackdrop').modal('show'); // Afficher le modal de confirmation
        });

        // Gestionnaire d'événement pour le formulaire de confirmation
        $('#confirmForm').submit(function(e) {
            e.preventDefault(); // Empêcher la soumission du formulaire

            // Envoyer une requête AJAX au script PHP pour effectuer la mise à jour
            $.ajax({
                url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', // URL du script PHP actuel
                method: 'POST',
                data: $(this).serializeArray(), // Données du formulaire
                success: function(response) {
                    // Gérer la réponse du serveur
                    console.log(response); // Afficher la réponse dans la console
                    // Vous pouvez ajouter ici un code pour actualiser la page ou afficher un message de succès
                },
                error: function(xhr, status, error) {
                    // Gérer les erreurs de la requête AJAX
                    console.error(xhr, status, error);
                }
            });

            $('#staticBackdrop').modal('hide'); // Cacher le modal de confirmation
        });
    });
</script>