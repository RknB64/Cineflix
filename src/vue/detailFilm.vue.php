<div class="card w-auto mb-3 my-2 mx-2" data-bs-theme="dark">
    <div class="row g-0">
        <div class="col-md-6 mt-1">
            <img src="static/img/<?= $detailFilm->id_affiche ?>.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <h5 class="card-title"><?= $detailFilm->titre ?></h5>
                <hr>
                <p class="card-text"><?= $detailFilm->description ?></p>
                <p class="card-text"><small class="text-body-secondary"><?= $detailFilm->duree ?></small></p>
                <hr>
                <form id="formulaire-cinema" action="" method="post">
                    <div class="d-flex d-inline-block col-md-6">
                        <select class="form-select col-md-3" id="ville-select" name="ville-select" aria-label="Default select example">
                            <option value="" selected disabled hidden>Selectionner une ville</option>
                            <?php
                            foreach ($detailFilm->villes as $key => $ville) {
                            ?>
                                <option value=<?= $ville->id ?>><?= $ville->nom ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <select class="form-select col-md-3" id="cinema-select" name="cinema-select" aria-label="Default select example">
                        </select>
                    </div>
                    <!-- <div class="d-flex d-inline-block">
                        <select class="form-select" id="seance-select" aria-label="Default select example">
                        </select>
                    </div> -->
                    <div class="btn-group d-inline-block my-1" id="test" name="seance-select" role="group" aria-label="Basic radio toggle button group">
                    </div>
                    <div class="d-flex d-inline-block">
                        <label class="form-label col-md-4" id="place-select-label">Nombre de places</label>
                        <select class="form-select" id="place-select" name="place-select" aria-label="Default select example">
                            <option value="" selected disabled hidden>Selectionner</option>
                            <?php
                            for ($i = 0; $i < 10; $i++) {
                            ?>
                                <option value=<?= $i + 1 ?>><?= $i + 1 ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end mt-1">
                        <input class="btn btn-secondary" id="achat-place" type="submit" value="ACHETER">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>