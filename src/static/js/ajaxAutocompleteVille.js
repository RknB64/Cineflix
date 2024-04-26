/*
  Ajax pour autocompléter le nom des villes depuis la bd.

  Pour utiliser :
  - Ajouter un input dans la vue avec un id unique
  - Appeler la fonction "autocompleteVille" avec en parametre l'id de l'input dans lequel on veut compléter les villes

  Exemple :

            <script src="/static/js/ajaxAutocompleteVille.js"></script>

            <script>
              autocompleteVille('form_ville_name');
            </script>

            <input type='text' id='form_ville_name'>

  La fonction ajoute les divs nécessaires pour faire les suggestions de noms de ville
  Et ajoute un input hidden avec en valeur l'id de la ville sélectionné. Cet input peut être utilisé avec le nom 'ville_id' (ex: $_POST['ville_id'])

*/

function autocompleteVille(inputId) {


  let villeIdInputId = inputId + '-ville-id';
  let villeIdInput = "<input class='form-control' type='hidden' name='ville_id' id='" + villeIdInputId +"'>";

  let suggestionBoxId = inputId + '-suggestion-box'
  let suggestionBox = "<div class='position-relative'>";
  suggestionBox += "<div class='position-absolute suggestion-box-ville' id='" + suggestionBoxId + "'></div></div>"
  console.log( 'hello' );

  $(document).ready(function() {
    console.log( 'boo' );

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

  $('#'+inputId + '-ville-id').val(villeId);
  $('#' + inputId).focus();
}

// hide la suggestion si on clique ailleur
$(document).click(function(event) {
  if (!$(event.target).closest('.suggestion-box-ville').length) {
    $('.suggestion-box-ville').hide();
  }
});
