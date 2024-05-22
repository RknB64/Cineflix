
function ajaxToggleAdmin(event) {

  const idAdherent = event.target.dataset.idadherent;

  $.ajax({
    type: "POST",
    url: "?action=ajaxRequest",
    data: {
      idAdherent: idAdherent,
      request: 'toggle-admin'
    },
    beforeSend: function() {
      console.log( idAdherent );
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

function ajaxDeleteAdherent(event) {

  const idAdherent = event.target.dataset.id;

  $.ajax({
    type: "POST",
    url: "?action=ajaxRequest",
    data: {
      idAdherent: idAdherent,
      request: 'delete-adherent'
    },
    beforeSend: function() {
      console.log( idAdherent );
    },
    error: function() {
      alert("Erreur, veuillez réessayer")
    },
    success: function(data) {
      console.log( data );

      $('#tr-' + idAdherent).remove();
    }
  });

}
