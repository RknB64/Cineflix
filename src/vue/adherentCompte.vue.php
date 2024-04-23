<div class="accordion mt-3 w-75 mx-auto" id="accordionPanelsStayOpenExample" data-bs-theme="dark">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Détails de mon compte
            </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <ol class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Mes points</div>
                            <small>Pour visionner les films en <a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" href="?action=streaming">streaming</a> !</small>
                        </div>
                        <h2>
                            <span class="badge text-bg-danger rounded-pill"><?= $adherent->points ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 20 20">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                            </span>
                        </h2>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Mes films</div>
                            <small>Films en streaming que je peux voir !</small>
                        </div>
                        <a class="btn btn-secondary btn-lg" role="button" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 18 18">
                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                            Voir
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                Informations personnelles
            </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
            <div class="accordion-body">
                <ol class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control-plaintext" id="name-label" value=<?= $adherent->nom ?>>
                            <label for="floatingPlaintextInput">Nom</label>
                        </div>
                        <form class="row g-3 my-auto">
                            <div class="col-auto">
                                <input type="text" class="form-control" name="compte-mod-nom" id="compte-mod-nom" placeholder="Nouveau nom">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success mb-3">Modifier</button>
                            </div>
                        </form>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control-plaintext" id="prenom-label" value=<?= $adherent->prenom ?>>
                            <label for="floatingPlaintextInput">Prénom</label>
                        </div>
                        <form class="row g-3 my-auto">
                            <div class="col-auto">
                                <input type="text" class="form-control" name="compte-mod-prenom" id="compte-mod-prenom" placeholder="Nouveau prénom">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success mb-3">Modifier</button>
                            </div>
                        </form>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control-plaintext" id="name-label" value=<?= $ville->nom ?>>
                            <label for="floatingPlaintextInput">Ville</label>
                        </div>
                        <form class="row g-3 my-auto">
                            <div class="col-auto">
                                <input type="text" class="form-control" name="compte-mod-ville" id="compte-mod-ville" placeholder="Nouvelle ville">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success mb-3">Modifier</button>
                            </div>
                        </form>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                Gérer mon compte
            </button>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
            <div class="accordion-body">
                <!-- <p>date de création</p>
                <p>mail</p>
                <p>mot de passe</p>
                <p>supprimer mon compte</p> -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control-plaintext" id="date-label" value=<?= $adherent->date_creation ?>>
                            <label for="floatingPlaintextInput">Date de création du compte</label>
                        </div>
                    </li>
                </ul>
                <ol class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="form-floating mb-3">
                            <input type="email" readonly class="form-control-plaintext" id="email-label" value=<?= $adherent->mail ?>>
                            <label for="floatingPlaintextInput">E-mail</label>
                        </div>
                        <form class="row g-3 my-auto">
                            <div class="col-auto">
                                <input type="email" class="form-control" name="compte-mod-mail" id="compte-mod-mail" placeholder="Nouvel e-mail">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger mb-3">Modifier</button>
                            </div>
                        </form>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control-plaintext" id="name-label" value="Mot de passe">
                            <label for="floatingPlaintextInput" hidden>mdp</label>
                        </div>
                        <form class="row g-3 my-auto">
                            <div class="col-auto">
                                <input type="password" class="form-control" name="compte-mod-mdp" id="compte-mod-mdp" placeholder="Nouveau mot de passe">
                            </div>
                            <div class="col-auto">
                                <input type="password" class="form-control" name="compte-conf-mdp" id="compte-conf-mdp" placeholder="Confirmer le mot de passe">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger mb-3">Modifier</button>
                            </div>
                        </form>
                    </li>
                    <li class="list-group-item">
                        <!-- <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control-plaintext" id="name-label" value="Mot de passe">
                            <label for="floatingPlaintextInput" hidden>mdp</label>
                        </div> -->
                        <form class="row g-3 my-auto d-flex justify-content-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Cochez cette case pour supprimer le compte (NB : cette action est irréversible.)
                                </label>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger mb-3">Supprimer le compte</button>
                            </div>
                        </form>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>