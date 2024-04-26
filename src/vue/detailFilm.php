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
                        <div class="btn-group d-inline-block my-1" id="seance-select" name="seance-select" role="group" aria-label="Basic radio toggle button group">
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
  const villeSelect = document.getElementById('ville-select');
  const cinemaSelect = document.getElementById('cinema-select');
  const seanceSelect = document.getElementById('seance-select');
  const placeSelectLabel = document.getElementById('place-select-label');
  const placeSelect = document.getElementById('place-select');
  const boutonAchat = document.getElementById('achat-place');
  cinemaSelect.hidden = true;
  seanceSelect.hidden = true;
  placeSelectLabel.hidden = true;
  placeSelect.hidden = true;
  placeSelect.disabled = true;
  boutonAchat.disabled = true;

  const villesAvecCinemas = <?php echo json_encode($villesAvecCinemas); ?>;

  villeSelect.addEventListener('change', function() {
    cinemaSelect.hidden = false;
    placeSelectLabel.hidden = true;
    seanceSelect.hidden = true;
    placeSelect.hidden = true;
    placeSelect.disabled = true;
    boutonAchat.disabled = true;
    const selectedVilleId = this.value;
    const selectedVille = villesAvecCinemas.find(ville => ville.id == selectedVilleId);
    cinemaSelect.innerHTML = '<option value="" selected disabled hidden>Sélectionnez un cinéma</option>';
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


  cinemaSelect.addEventListener('change', function() {
    placeSelectLabel.hidden = true;
    seanceSelect.hidden = false
    placeSelect.hidden = true;
    placeSelect.disabled = true;
    boutonAchat.disabled = true;
    const selectedCinemaId = this.value;
    const selectedCinema = cinemasAvecSeances.find(cinema => cinema.id == selectedCinemaId);
    seanceSelect.innerHTML = ''
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

        // groupe bouton toggle des dates de la semaine ou 2 semaines
        // (comme pathé qui propose 10 jours à partir d'aujourd'hui)
        // On compare la date de seance à un bouton pour qu'il soit supérieur et un inférieur
        // On ajoute la séance

        const inputHtml = '<input type="radio" class="btn-check" name="btnradio" id="btnradio' + seance.id + '" autocomplete="off" value="' + seance.id + '">'
        const labelHtml = '<label class="btn btn-outline-secondary" for="btnradio' + seance.id + '">'
        const cardHtml = '<div class="card py-0 px-0 border-0 bg-transparent" style="width: 4rem; height: 5rem;">'
        const cardBodyHtml = '<div class="card-body py-0 px-0">'
        const cardTitleHtml = '<p class="card-title" name="date-seance">' + day + ' ' + month + '</p><hr>'
        const cardSubtitleHtml = '<p class="card-subtitle text-body-secondary" name="horaire-seance">' + time + '</p>'
        const balisesClosers = '</div></div></label>'

        seanceSelect.innerHTML += inputHtml + labelHtml + cardHtml + cardBodyHtml + cardTitleHtml + cardSubtitleHtml + balisesClosers;
      });
      seanceSelect.disabled = false;
    } else {
      seanceSelect.disabled = true;
    };
  });

  seanceSelect.addEventListener('change', function() {
    placeSelectLabel.hidden = true;
    boutonAchat.disabled = true;
    placeSelectLabel.hidden = false;
    placeSelect.hidden = false;
    placeSelect.disabled = false;
  });

  placeSelect.addEventListener('change', function() {
    boutonAchat.disabled = false;
  });


  //Récupération des données de formulaire
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
