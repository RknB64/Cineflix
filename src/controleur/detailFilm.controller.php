<?php

require(RACINE . "/modele/FilmDetail.php");

if (isset($_GET["id"])) {

    $detailFilm = new FilmDetail($_GET["id"]);

    $data = [
        'seances' => $detailFilm->seances,
        'salles' => $detailFilm->salles,
        'cinemas' => $detailFilm->cinemas,
        'villes' => $detailFilm->villes
    ];

    // Créer un tableau vide pour stocker les villes avec les cinémas
    $villesAvecCinemas = [];

    // Associer les cinémas à leurs villes respectives
    foreach ($data['villes'] as $ville) {
        $ville->cinemas = [];
        foreach ($data['cinemas'] as $cinema) {
            if ($cinema->id_ville === $ville->id) {
                $ville->cinemas[] = $cinema;
            }
        }
        $villesAvecCinemas[] = $ville;
    }

    // Associer les séances à leurs cinémas et salles respectifs dans chaque ville
    foreach ($villesAvecCinemas as $ville) {
        foreach ($ville->cinemas as $cinema) {
            $cinema->seances = [];
            foreach ($data['seances'] as $seance) {
                foreach ($data['salles'] as $salle) {
                    if ($seance->id_salle === $salle->id && $salle->id_cinema === $cinema->id) {
                        $cinema->seances[] = $seance;
                    }
                }
            }
        }
    }

    // Supprimer les doublons de séances
    foreach ($detailFilm->cinemas as $cinema) {
        foreach ($cinema->seances as $seance) {
            if (!isset($seancesUniques[$seance->id])) {
                $seancesUniques[$seance->id] = $seance;
            }
        }
        $cinema->seances = array_values($seancesUniques);
    }


    $titre = $detailFilm->titre;

    include './vue/header.html.php';
    include './vue/detailFilm.vue.php';
    include './vue/footer.html.php';
    // echo '<pre>';
    // print_r($detailFilm->cinemas[1]->seances);
    // print_r($detailFilm);
    // die();
}
?>

<script>
    const villeSelect = document.getElementById('ville-select');
    const cinemaSelect = document.getElementById('cinema-select');
    // const seanceSelect = document.getElementById('seance-select');
    const placeSelectLabel = document.getElementById('place-select-label');
    const placeSelect = document.getElementById('place-select');
    const boutonAchat = document.getElementById('achat-place');
    const test = document.getElementById('test');
    cinemaSelect.hidden = true;
    // seanceSelect.hidden = true;
    placeSelectLabel.hidden = true;
    placeSelect.hidden = true;
    placeSelect.disabled = true;
    boutonAchat.disabled = true;
    test.hidden = true;

    const villesAvecCinemas = <?php echo json_encode($villesAvecCinemas); ?>;

    villeSelect.addEventListener('change', function() {
        cinemaSelect.hidden = false;
        placeSelectLabel.hidden = true;
        placeSelect.hidden = true;
        placeSelect.disabled = true;
        boutonAchat.disabled = true;
        test.hidden = true;
        const selectedVilleId = this.value;
        const selectedVille = villesAvecCinemas.find(ville => ville.id == selectedVilleId);
        cinemaSelect.innerHTML = '<option value="" selected disabled hidden>Sélectionnez un cinéma</option>';
        // seanceSelect.innerHTML = '<option value="">Sélectionnez une séance</option>';
        if (selectedVille) {
            selectedVille.cinemas.forEach(cinema => {
                const option = document.createElement('option');
                option.value = cinema.id;
                option.textContent = cinema.nom;
                cinemaSelect.appendChild(option);
            });
            cinemaSelect.disabled = false;
        } else {
            cinemaSelect.disabled = true;
            seanceSelect.disabled = true;
        }
    });

    const cinemasAvecSeances = <?php echo json_encode($detailFilm->cinemas); ?>;

    // cinemaSelect.addEventListener('change', function() {
    //     seanceSelect.hidden = false;
    //     const selectedCinemaId = this.value;
    //     const selectedCinema = cinemasAvecSeances.find(cinema => cinema.id == selectedCinemaId);
    //     seanceSelect.innerHTML = '<option value="">Sélectionnez une séance</option>';
    //     if (selectedCinema) {
    //         selectedCinema.seances.forEach(seance => {
    //             const option = document.createElement('option');
    //             option.value = seance.id;
    //             option.textContent = seance.horaire_date;
    //             seanceSelect.appendChild(option);
    //         });
    //         seanceSelect.disabled = false;
    //     } else {
    //         seanceSelect.disabled = true;
    //     }
    // });

    cinemaSelect.addEventListener('change', function() {
        placeSelectLabel.hidden = true;
        placeSelect.hidden = true;
        placeSelect.disabled = true;
        boutonAchat.disabled = true;
        test.hidden = false;
        const selectedCinemaId = this.value;
        const selectedCinema = cinemasAvecSeances.find(cinema => cinema.id == selectedCinemaId);
        test.innerHTML = ''
        if (selectedCinema) {
            selectedCinema.seances.forEach(seance => {
                const date = new Date(Date.parse(seance.horaire_date))
                const day = date.getDate()
                const monthsList = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
                const month = monthsList[date.getMonth()];
                const year = date.getYear()
                let hours = date.getHours()
                if (hours < 10) hours = '0' + hours
                let minutes = date.getMinutes()
                if (minutes < 10) minutes = '0' + minutes
                const time = hours + ':' + minutes

                const inputHtml = '<input type="radio" class="btn-check" name="btnradio" id="btnradio' + seance.id + '" autocomplete="off" value="' + seance.id + '">'
                const labelHtml = '<label class="btn btn-outline-secondary" for="btnradio' + seance.id + '">'
                const cardHtml = '<div class="card py-0 px-0 border-0 bg-transparent" style="width: 4rem; height: 5rem;">'
                const cardBodyHtml = '<div class="card-body py-0 px-0">'
                const cardTitleHtml = '<p class="card-title" name="date-seance">' + day + ' ' + month + '</p><hr>'
                const cardSubtitleHtml = '<p class="card-subtitle text-body-secondary" name="horaire-seance">' + time + '</p>'
                const balisesClosers = '</div></div></label>'

                test.innerHTML += inputHtml + labelHtml + cardHtml + cardBodyHtml + cardTitleHtml + cardSubtitleHtml + balisesClosers;
            });
        };
    });

    // seanceSelect.addEventListener('change', function() {
    //     placeSelectLabel.hidden = false;
    //     placeSelect.hidden = false;
    //     placeSelect.disabled = false;
    // });

    test.addEventListener('change', function() {
        placeSelectLabel.hidden = true;
        boutonAchat.disabled = true;
        placeSelectLabel.hidden = false;
        placeSelect.hidden = false;
        placeSelect.disabled = false;
    });

    placeSelect.addEventListener('change', function() {
        boutonAchat.disabled = false;
    });


    document.getElementById("formulaire-cinema").addEventListener("submit", function(event) {
        event.preventDefault();

        const ville = document.getElementById("ville-select").value;
        const cinema = document.getElementById("cinema-select").value;
        const seances = document.getElementsByName("btnradio");
        let seanceChoisie;
        for (let i = 0; i < seances.length; i++) {
            if (seances[i].checked) {
                seanceChoisie = seances[i].value;
                break;
            }
        }
        const place = document.getElementById("place-select").value;

        if (ville === '' || cinema === '' || seanceChoisie === '' || place === '') {
            alert('Veuillez remplir tous les champs')
        } else {
            alert("ville : " + ville + "\ncinema : " + cinema + "\nseance Id : " + seanceChoisie + "\nnombre de places : " + place);
        }
    });
</script>