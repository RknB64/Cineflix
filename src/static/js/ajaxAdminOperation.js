
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

        const td = $('#estAdmin-' + idAdherent);
        let text = td.html() === 'Oui' ? 'Non' : 'Oui';
        td.html(text)
      }
    });

  }

  static delete(event, params) {
    switch (params.table) {
      case 'adherent':
        this.deleteAdherent(event);
        break;
      case 'film':
        // TODO
        break;
    }
  }

  static deleteAdherent(event) {

    const idAdherent = event.target.dataset.id;

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
        console.log();
      },
      error: function(e) {
        console.log(e);
        alert("Erreur, vérifiez les informations fournies et réessayez")
      },
      success: function(newAdherent) {
        console.log( newAdherent );
        const formJq = $("#film-form");
        formJq.trigger("reset");

        const tr = document.createElement('tr');
        tr.id = 'tr-'+newAdherent.id;

        Object.entries(newAdherent).forEach(info => {
          const key = info[0];
          const value = info[1];

          const td = document.createElement('td');
          td.innerText = value;
          tr.append(td);
        });
        const firstTr = document.querySelector("#film-form-tr");
        firstTr.before(tr);
      }
    });

  }

}
