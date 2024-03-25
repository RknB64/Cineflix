<div class="container">
    <h1>Search Results</h1>
    
    <?php if (!empty($results)): ?>
        <div class="filmCards px-3 d-flex flex-wrap row-cols-md-5 align-content-start">
            <?php foreach ($results as $item): ?>
                <div class="filmCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">
                    <div class="btn mx-0 my-0 py-0 px-0">
                        <img src="static/img/<?= $item->id_affiche ?>.jpg" class="card-img rounded" alt="..." data-bs-toggle="offcanvas" data-bs-target="#offcanvas<?= $item->id ?>WithBothOptions" aria-controls="offcanvasWithBothOptions">
                    </div>
                    <br><br>
                    <a href="#" class="btn btn-dark w-100">Réserve ta place !</a>
                </div>

                <!-- OffCanvas -->
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvas<?= $item->id ?>WithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title fw-bold" id="offcanvasWithBothOptionsLabel"><?= $item->titre ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <img src="static/img/<?= $item->id_affiche ?>.jpg" class="card-img rounded" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item mx-auto">
                                <div class="btn" data-bs-toggle="modal" data-bs-target="#video<?= $item->id ?>Modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z" />
                                    </svg>
                                </div>
                                <div class="btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text px-2 py-2"><?= $item->description ?></p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text d-flex justify-content-between"><small class="text-white-70 fst-italic">Durée : <?= $item->duree ?></small>
                                    <a href="#" class="btn btn-dark">Réserve ta place !</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- VideoModal -->
                <div class="modal fade" id="video<?= $item->id ?>Modal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel"><?= $item->titre ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div> -->
                            <div class="modal-body">
                                <div class="ratio ratio-16x9 embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="static/vids/Nioh 2 - Opening Cinematic.mp4" title="YouTube video" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>
