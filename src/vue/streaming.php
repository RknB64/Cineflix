<?php

if (!CurrentUser::isLoggedIn()) {
?>
    <div class="card text-center mt-4 w-75 mx-auto" data-bs-theme="dark">
        <div class="card-header">
            Découvrez un monde de divertissement illimité !
        </div>
        <div class="card-body">
            <h4 class="card-title">Connectez-vous ou inscrivez-vous pour débloquer toutes les surprises !</h4>
            <br>
            <p class="card-text">Plongez dans un océan de divertissement sans limites avec notre catalogue de streaming exclusif !</p>
            <p class="card-text">Des milliers de films, séries, documentaires et bien plus vous attendent, prêts à être explorés.</p>
            <p class="card-text">Le meilleur du divertissement vous attend !</p>
            <br>
            <button class="btn btn-light col-6 mx-auto" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion/Inscription</button>
        </div>
    </div>
<?php
    echo file_get_contents(RACINE . '/vue/component/loginModal.html', true);
}
