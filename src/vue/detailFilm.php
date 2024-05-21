<?php if ($detailFilm->etat == 'streaming') { ?>

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
                    <form id="formulaire-streaming" action="?action=mes-streams" method="post">
                        <div class="d-flex justify-content-end mt-1">
                            <input type="text" hidden id="achat-stream" name="id-stream" value=<?= $detailFilm->id ?>>
                            <?php if (!$streamBought && $enoughPoints) { ?>
                                <button type="button" id="btn-achat-stream" class="btn btn-secondary" onclick="confirmationModalAchatStream()">ACHETER POUR 15 POINTS</button>
                            <?php } else if (!$streamBought && !$enoughPoints) { ?>
                                <input class="btn btn-secondary" id="enough-points" value="Pas assez de points !" disabled>
                            <?php  } else { ?>
                                <input class="btn btn-secondary" id="achat-done" value="Déjà acheté" disabled>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>

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
                    <?php
                    if (count($detailFilm->seances) !== 0) {
                    ?>
                        <?php if (CurrentUser::isLoggedIn()) { ?>
                            <form id="formulaire-cinema" action="?action=achat" method="post">
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
                                <div class="btn-group d-inline-block my-1" id="seance-select" name="seance" role="group" aria-label="Basic radio toggle button group">
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
                                    <input class="btn btn-secondary" id="achat-place" type="submit" value="ACHETER" formtarget="_blank">
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="d-flex justify-content-end mt-1">
                                <button type="button" class="btn btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter pour acheter</button>
                            </div>
                        <?php } ?>
                    <?php
                    } else {
                    ?>
                        <p class="card-text"><small class="text-body-secondary">Aucune séance trouvée.</small></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // définie les variables utilisées dans le js
        const villesAvecCinemas = <?php echo json_encode($villesAvecCinemas); ?>;
        const cinemasAvecSeances = <?php echo json_encode($detailFilm->cinemas); ?>;
    </script>
    <script src="static/js/detailFilm.js"></script>

<?php }

echo file_get_contents(RACINE . '/vue/component/confirmModal.html', true);
