<h1 class="fw-bold ms-4 my-4 ps-2 text-white">Mes films</h1>

<div class="filmCards px-3 d-flex flex-wrap row-cols-md-5 align-content-start">

    <?php

    if (!$filmBought) { ?>
        <div class="card text-center mt-4 w-75 mx-auto" data-bs-theme="dark">
            <div class="card-header">
                <h4 class="card-title">Vous n'avez aucun film !</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Plongez dans un océan de divertissement sans limites avec notre catalogue de streaming exclusif !</p>
                <p class="card-text">Des milliers de films, séries, documentaires et bien plus vous attendent, prêts à être explorés.</p>
                <p class="card-text">Le meilleur du divertissement vous attend !</p>
                <br>
                <a class="btn btn-light col-6 mx-auto" href="?action=streaming">Voir les films disponibles</a>
            </div>
        </div>
        <?php } else {

        foreach ($adherentFilms as $index => $film) {

        ?>
            <div class="filmCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">
                <div class="btn mx-0 my-0 py-0 px-0">
                    <img src="static/img/<?= $film->id_affiche ?>.jpg" class="card-img rounded" alt="..." data-bs-toggle="offcanvas" data-bs-target="#offcanvas<?= $index ?>WithBothOptions" aria-controls="offcanvasWithBothOptions">
                </div>
                <br><br>
                <a href="" class="btn btn-dark w-100">Visionner</a>
            </div>

    <?php }
    } ?>