
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
      alert("Erreur d'ajout")
    },
    success: function(data) {
      console.log( data );
      $('#estAdmin-' + idAdherent).innerText = "blaaa";
    }
  });

}
