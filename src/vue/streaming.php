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
} else { ?>
    <div class="filmCards px-3 d-flex flex-wrap row-cols-md-5 align-content-start">

        <?php

        if ($allFilmsStreaming === null) echo "Aucun film trouvé.";

        foreach ($allFilmsStreaming as $index => $film) {

        ?>
            <div class="filmCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">
                <div class="btn mx-0 my-0 py-0 px-0">
                    <img src="static/img/<?= $film->id_affiche ?>.jpg" class="card-img rounded" alt="..." data-bs-toggle="offcanvas" data-bs-target="#offcanvas<?= $index ?>WithBothOptions" aria-controls="offcanvasWithBothOptions">
                </div>
                <br><br>
                <a href="?action=detailFilm&&id=<?= $film->id ?>" class="btn btn-dark w-100">Voir les détails !</a>
            </div>

    <?php }
    } ?>