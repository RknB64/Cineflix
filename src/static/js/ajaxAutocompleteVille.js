/*
  Ajax pour autocompléter le nom des villes depuis la bd.

  Pour utiliser, il faut définir dans la vue :
  Un input avec l'id 'ville_name', dans lequel l'user saisie la ville au clavier
  Un div avec l'id 'suggestion-box-ville' pour indiquer 
  Éventuellement un input avec l'id 'ville_id' en type hidden dans lequel l'id de la ville sera automatiquement saisie

  Exemple :

            <input type='text' id='ville_name'>
            <input type='hidden' id='ville_id'>

            <div class='position-relative'>
              <div class='position-absolute' id='suggesstion-box-ville'></div>
            </div>

            <script src="/static/js/ajaxAutocompleteVille.js"></script>
            <script>
              autocompleteVille();
            </script>
*/

// AJAX call for autocomplete 
const REQUEST_TYPE = 'autocomplete-ville';

function autocompleteVille() {

  $(document).ready(function() {
    $("#ville_name").keyup(function() {
      $.ajax({
        type: "POST",
        url: "/controleur/ajaxRequestController.php",
        data: {
          keyword: $(this).val(),
          request: REQUEST_TYPE
        },
        beforeSend: function() {
          $("#ville_name").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data) {
          $("#suggesstion-box-ville").show();
          $("#suggesstion-box-ville").html(data);
          $("#ville_name").css("background", "#FFF");
        }
      });
    });
  });
}


// function utilisée par la vue retournée par l'ajax (TODO c'est pas terrible comme systeme, passer le nom de la fn en data ??)
function selectValue(val, id) {
  $("#ville_name").val(val);
  $("#suggesstion-box-ville").hide();

  $("#ville_id").val(id);
}

$(document).click(function(event) {
  if (!$(event.target).closest('#suggesstion-box-ville').length) {
    $('#suggesstion-box-ville').hide();
  }
});
