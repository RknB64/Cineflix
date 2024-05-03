<style>
    /* Custom CSS for films container */

    /* Adjustments for responsiveness */
    @media (max-width: 768px) {
        .films-container {
            padding: 3px;
        }
    }

    /* Animation keyframes */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }
</style>
<h1 class="text-white">Résultat recherche pour <?= $villeName ?></h1>

<?php if (!empty($results)) : ?>
    <div class="filmCards px-3 d-flex flex-wrap gap-3 row-cols-md-5 align-content-start text-white">
        <?php foreach ($results as $item) : ?>
            <div class="filmCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">
                <img src="static/img/cinema/<?= $item->id_affiche ?>.jpg" class="card-img rounded" alt="...">
                <div class="film-details">
                    <h5 class="fw-bold"><?= $item->nom ?></h5>
                    <p class="card-text"><?= $item->adresse ?></p>

                    <!-- Button to show films for this cinema -->
                    <button class="btn btn-dark show-films" data-cinema-id="<?= $item->id ?>">Voir les films</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No results found.</p>
<?php endif; ?>

<?php foreach ($results as $item) : ?>
    <!-- Container to display films for each cinema (hidden by default) -->
    <div class="films-container mt-3 d-none" id="films-container-<?= $item->id ?>">
        <div class="row row-cols-1 row-cols-md-7 g-3">
           
        </div>




    </div>
<?php endforeach; ?>
