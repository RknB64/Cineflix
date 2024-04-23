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
    <div class="films-container mt-3 d-flex" id="films-container-<?= $item->id ?>">
        <div class="bg-light g-4">
            <!-- Film items will be dynamically added here -->
        </div>

  
    </div>
    <?php endforeach; ?>

    <script>
    $(document).ready(function() {
        $('.show-films').click(function() {
            var cinemaId = $(this).data('cinema-id'); // Get the cinema ID
            var filmsContainer = $('#films-container-' + cinemaId);

            // Check if the films container is visible
            if (filmsContainer.hasClass('d-none')) {
                // AJAX request to fetch films for the selected cinema
                $.ajax({
                    url: 'http://localhost:81/?action=search&cinema=' + cinemaId,
                    type: 'GET',
                    dataType: 'json', // Specify JSON dataType for parsing JSON response
                    success: function(response) {
                        // Generate HTML content to display film details
                        var filmsHTML = '';
                        if (response.error) {
                            filmsHTML = '<p>' + response.error + '</p>';
                        } else {
                            // console.log(response);
                            // return false;

                            response.forEach(function(film) {
                                filmsHTML += `<div class=" filmCards px-3 d-flex flex-wrap align-content-start text-white">
                                                <div class="filmCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">
                                                    <div class="btn mx-0 my-0 py-0 px-0">
                                                        <img src="static/img/${film.id_affiche}.jpg" class="card-img rounded-start" alt="${film.titre}">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">${film.titre}</h5>
                                                            <p class="card-text">${film.description}</p>
                                                            <p class="card-text"><small class="text-white">Durée: ${film.duree}</small></p>
                                                            <a href="?action=film-details&&id=${film.id}" class="btn btn-primary" role="button">Réserver places</a>

                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>`
                            });
                            
                        }
                        // Display the generated HTML content in the films container
                        filmsContainer.html(filmsHTML).removeClass('d-none');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                // Hide the films container if it's already visible
                filmsContainer.addClass('d-none');
            }
        });
    });
</script>
