<form class="d-flex d-inline-block justify-content-evenly mt-4">
    <div class="d-flex d-inline-block">
        <input class="form-control me-2" type="search" placeholder="Rechercher par titre..." aria-label="Search">
        <button class="btn btn-dark btn-sm" type="submit">Search</button>
    </div>
    <div class="d-flex d-inline-block">
        <input class="form-control me-2" type="search" placeholder="Rechercher par ville..." aria-label="Search">
        <button class="btn btn-dark btn-sm" type="submit">Search</button>
    </div>
</form>

<br>
<div id="carouselInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2000">
            <img src="static/img/1.jpg" class="d-block w-100 img-fluid shadow" alt="fast11">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <img src="static/img/2.jpg" class="d-block w-100 img-fluid shadow" alt="wick4">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="d-flex d-inline-block justify-content-between">
    <h1 class="fw-bold mx-4 my-4 pe-4 ps-2 shadow flex-grow-1">Liste des Films</h1>
    <a href="#" class="mx-4 my-4 px-4 pt-3 shadow text-secondary-emphasis">Voir tous les films</a>
</div>

<div class="filmCards d-flex flex-wrap row-cols-md-4 align-content-start">

    <?php

    if (count($listeFilms) === 0) echo "Aucun film trouvé.";

    for ($i = 0; $i < count($listeFilms); $i++) {

    ?>
        <div class="filmCard border border-light-50 border-1 rounded px-2 py-2  my-1 shadow">
            <img src="static/img/<?= $listeFilms[$i]['id_affiche'] ?>.jpg" class="card-img rounded" alt="...">
            <div class="card-body">
                <h5 class="card-title text-white-70 fw-bold px-2 py-2"><?= $listeFilms[$i]['titre'] ?></h5>
                <hr>
                <p class="card-text text-white-70 px-2 py-2"><?= $listeFilms[$i]['description'] ?></p>
                <hr>
                <p class="card-text d-flex justify-content-between"><small class="text-muted fst-italic">Durée : <?= $listeFilms[$i]['duree'] ?></small><a href="#" class="btn btn-dark">Voir détails</a></p>
            </div>
        </div>

        <!-- Pour l'essai de plus de 2 films -->
        <div class="filmCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">
            <img src="static/img/<?= $listeFilms[$i]['id_affiche'] ?>.jpg" class="card-img rounded" alt="...">
            <div class="card-body">
                <h5 class="card-title text-white-70 fw-bold px-2 py-2"><?= $listeFilms[$i]['titre'] ?></h5>
                <hr>
                <p class="card-text text-white-70 px-2 py-2"><?= $listeFilms[$i]['description'] ?></p>
                <hr>
                <p class="card-text d-flex justify-content-between"><small class="text-muted fst-italic">Durée : <?= $listeFilms[$i]['duree'] ?></small><a href="#" class="btn btn-dark">Voir détails</a></p>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<!-- list de streams -->
<div class="d-flex d-inline-block justify-content-between">
    <h1 class="fw-bold mx-4 my-4 pe-4 ps-2 shadow flex-grow-1">Liste des Streams</h1>
    <a href="#" class="mx-4 my-4 px-4 pt-3 shadow text-secondary-emphasis">Voir tous les streams</a>
</div>

<div class="streamCards d-flex flex-wrap row-cols-md-4 align-content-start">

    <?php
    if (empty($listeStreams)) {
        echo "Aucun stream trouvé.";
    } else {
        foreach ($listeStreams as $stream) {
    ?>
            <div class="streamCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">
                <div class="card-body">
                    <!-- <h5 class="card-title text-white-70 fw-bold px-2 py-2">Stream ID: <?= $stream['id'] ?></h5> -->
                   <!-- Add the image tag here -->
                   <img src="static/img/fast-furious-9.jpg" alt="Stream Image" class="card-img">
                    <!-- Other stream details -->
                    <hr>
                    
                    <p class="card-text text-white-70 px-2 py-2">Film ID: <?= $stream['id_film'] ?></p>
                    <p class="card-text text-white-70 px-2 py-2">Adherent ID: <?= $stream['id_adherent'] ?></p>
                    <p class="card-text text-white-70 px-2 py-2">Date d'expiration: <?php echo date('Y-m-d H:i:s', strtotime($stream['date_expiration'])); ?></p>
                    <p class="card-text text-white-70 px-2 py-2">Date d'achat:<?php echo date('Y-m-d H:i:s', strtotime($stream['date_expiration'])); ?></p>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>