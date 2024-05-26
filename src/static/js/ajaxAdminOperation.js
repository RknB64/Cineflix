/**
* @description Collection de fonctions pour réaliser les opérations d'administration depuis la page admin
**/
class AjaxAdmin {

  static toggleAdmin(event) {

    const idAdherent = event.target.dataset.idadherent;

    $.ajax({
      type: "POST",
      url: "?action=ajaxRequest",
      data: {
        idAdherent: idAdherent,
        request: 'toggle-admin'
      },
      beforeSend: function() {
        console.log(idAdherent);
      },
      error: function() {
        alert("Erreur, veuillez réessayer")
      },
      success: function() {

        // change la case admin de la table
        const td = $('#estAdmin-' + idAdherent);
        let text = td.html() === 'Oui' ? 'Non' : 'Oui';
        td.html(text)
      }
    });

  }

  static delete(event, params) {
    console.log(params.table);
    switch (params.table) {
      case 'adherent':
        this.deleteAdherent(event);
        break;
      case 'film':
        this.deleteFilm(event);
        break;
    }
  }

  static deleteAdherent(event) {

    const idAdherent = event.currentTarget.dataset.id;

    $.ajax({
      type: "POST",
      url: "?action=ajaxRequest",
      data: {
        idAdherent: idAdherent,
        request: 'delete-adherent'
      },
      beforeSend: function() {
      },
      error: function() {
        alert("Erreur, veuillez réessayer")
      },
      success: function() {
        $('#tr-' + idAdherent).remove();
      }
    });

  }

  static deleteFilm(event) {

    const idFilm = event.currentTarget.dataset.id;
    console.log(idFilm);

    $.ajax({
      type: "POST",
      url: "?action=ajaxRequest",
      data: {
        idFilm: idFilm,
        request: 'delete-film'
      },
      beforeSend: function() {
      },
      error: function() {
        alert("Erreur, veuillez réessayer")
      },
      success: function(response) {
        console.log(response);
        $('#tr-' + idFilm).remove();
      }
    });

  }

  // ajoute un film dans la bd, puis dans la table
  static addFilm() {

    const form = document.querySelector('#film-form');
    const formData = new FormData(form);
    formData.set("request", "add-film");

    $.ajax({
      type: "POST",
      url: "?action=ajaxRequest",
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function() {
      },
      error: function(xhr, status, error) {
        console.log("Status:", status);
        console.log("Error:", error);
        console.log("Response Text:", xhr.responseText);
        alert("Erreur, vérifiez les informations fournies et réessayez");
      },
      success: function(newFilm) {
        console.log(newFilm);
        this.addFilmToTable(newFilm);
      }.bind(this)

    });
  }

  // ajoute un film dans la table
  static addFilmToTable(newFilm) {

    $("#film-form").trigger("reset");

    const tr = document.createElement('tr');
    tr.id = 'tr-' + newFilm.id;


    let td = document.createElement('td');
    td.innerText = newFilm.id;
    tr.append(td);
    td = document.createElement('td');
    td.innerText = newFilm.titre;
    tr.append(td);
    td = document.createElement('td');
    td.innerText = newFilm.description;
    tr.append(td);
    td = document.createElement('td');
    td.innerText = newFilm.duree;
    tr.append(td);
    td = document.createElement('td');
    td.innerText = newFilm.etat;
    tr.append(td);
    td = document.createElement('td');
    td.innerText = newFilm.date_sortie;
    tr.append(td);
    td = document.createElement('td');
    td.innerText = newFilm.id_affiche;
    tr.append(td);
    td = document.createElement('td');
    td.innerText = newFilm.date_expiration;
    tr.append(td);

    tr.append(this.getDeleteButton(newFilm.id, 'film'));
    const lastTr = document.querySelector("#film-form-tr");
    lastTr.before(tr);
  }

  // renvoi un td contenant le bouton pour supprimer la ligne
  static getDeleteButton(objectId, table) {
    const td = document.createElement('td');

    const button = document.createElement('button');
    button.setAttribute('onclick', `AjaxAdmin.delete(event, {table: '${table}' })`);
    button.setAttribute('data-id', objectId);
    button.classList.add('btn', 'btn-danger');
    const icon = document.createElement('i');
    icon.classList.add('bi', 'bi-trash');

    button.appendChild(icon);
    td.appendChild(button);

    return td;
  }

}
