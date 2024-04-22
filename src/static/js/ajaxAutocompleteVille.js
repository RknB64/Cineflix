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

function autocompleteVille(inputId) {


  let villeIdInputId = inputId + '-ville-id';
  let villeIdInput = "<input type='hidden' id='" + villeIdInputId +"'>";

  let suggestionBoxId = inputId + '-suggestion-box'
  let suggestionBox = "<div class='position-relative'>";
  suggestionBox += "<div class='position-absolute suggestion-box-ville' id='" + suggestionBoxId + "'></div></div>"

  $(document).ready(function() {
    console.log( inputId + " " + suggestionBoxId );

    $('#'+inputId).after(suggestionBox);
    $('#'+inputId).after(villeIdInput);

    $('#'+inputId).keyup(function() {
      $.ajax({
        type: "POST",
        url: "?action=ajax",
        data: {
          keyword: $(this).val(),
          inputId: inputId,
          request: 'autocomplete-ville'
        },
        beforeSend: function() {
        },
        success: function(data) {

          console.log( suggestionBoxId );
          $('#'+ suggestionBoxId).show();
          $('#'+ suggestionBoxId).html(data);
        }
      });
    });
  });
}


// function utilisée par la vue retournée par l'ajax (TODO c'est pas terrible comme systeme, passer le nom de la fn en data ??)
function selectValue(inputId, villeName, villeId) {
  $('#' + inputId).val(villeName);
  $(".suggestion-box-ville").hide();

  $(inputId + '-ville-id').val(villeId);
}

// hide la suggestion si on clique ailleur
$(document).click(function(event) {
  if (!$(event.target).closest('.suggestion-box-ville').length) {
    $('.suggestion-box-ville').hide();
  }
});
