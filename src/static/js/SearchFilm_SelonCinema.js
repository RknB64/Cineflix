
    $(document).ready(function() {
        $('.show-films').click(function () {
            var cinemaId = $(this).data('cinema-id'); // Get the cinema ID
            var filmsContainer = $('#films-container-' + cinemaId);

            // Check if the films container is visible
            if (filmsContainer.hasClass('d-none')) {
                // AJAX request to fetch films for the selected cinema
                $.ajax({
                    url: 'http://localhost:81/?action=search&cinema=' + cinemaId,
                    type: 'GET',
                    dataType: 'json', // Specify JSON dataType for parsing JSON response
                    success: function (response) {
                        // Generate HTML content to display film details
                        var filmsHTML = '';
                        if (response.error) {
                            filmsHTML = '<p>' + response.error + '</p>';
                        } else {
                            // console.log(response);
                            // return false;
                            response.forEach(function (film) {
                                filmsHTML += '<div class="filmCards px-3 d-flex flex-wrap row-cols-md-5 align-content-start">';
                                filmsHTML += '    <div class="filmCard border border-light-50 border-1 rounded px-2 py-2 my-1 shadow">';
                                filmsHTML += '        <div class="btn mx-0 my-0 py-0 px-0">';
                                filmsHTML += '            <img src="static/img/' + film.id_affiche + '.jpg" class="card-img rounded-start" alt="' + film.titre + '">';
                                filmsHTML += '        </div>';
                                filmsHTML += '        <div class="col-md-8">';
                                filmsHTML += '            <div class="card-body">';
                                filmsHTML += '                <h5 class="card-title">' + film.titre + '</h5>';
                                filmsHTML += '                <p class="card-text">' + film.description + '</p>';
                                filmsHTML += '                <p class="card-text"><small class="text-muted">Durée: ' + film.duree + '</small></p>';
                                filmsHTML += '                <a href="?action=film-details&&id=' + film.id + '" class="btn btn-primary" role="button">Voir la bande-annonce</a>';

                                filmsHTML += '            </div>';
                                filmsHTML += '        </div>';
                                filmsHTML += '    </div>';
                                filmsHTML += '</div>';

                            });

                        }
                        // Display the generated HTML content in the films container
                        filmsContainer.html(filmsHTML).removeClass('d-none');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                // Hide the films container if it's already visible
                filmsContainer.addClass('d-none');
            }
        });
    });
