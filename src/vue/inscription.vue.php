<?php
// constantes pour manipuler les fields
const LABEL = UserRegister::LABEL;
const TYPE  = UserRegister::TYPE;
const NAME  = UserRegister::NAME;
const PROPERTIES  = UserRegister::PROPERTIES;
?>
<div class="mx-3">

  <div class="container mt-3">
    <h1 class="text-white">Je m'inscris</h1>
    <p class="text-white">Complétez le formulaire pour vous inscrire</p>
  </div>

  <div class="container bg-dark text-white p-4 mt-3 rounded border border-secondary">
    <form method="post" action="#">

      <?php foreach ($formFields as $field) : ?>

        <div class="w-75 mx-auto mb-3">
          <?php if ($field[TYPE] != 'hidden') : ?>
            <label for='<?= $id ?>'> <?= $field[LABEL] ?> </label>
          <?php endif; ?>
          <input class="form-control" type="<?= $field[TYPE] ?>" name="<?= $field[NAME] ?>" id="<?= $field[NAME] ?>" <?= $field[PROPERTIES] ?>>

          <?php if ($field[NAME] === 'ville_name') : ?>
            <div class="position-relative">
              <div class="position-absolute" id="suggesstion-box"></div>
            </div>
          <?php endif; ?>

        </div>


      <?php endforeach; ?>

      <div class="w-75 mx-auto mb-3">
        <button type="submit" class="btn btn-outline-light ">Submit</button>
      </div>
    </form>
  </div>
</div>

<script>
  // AJAX call for autocomplete 
  let requestType = '<?php echo AjaxHandler::AUTOCOMPLETE_VILLE; ?>';

  $(document).ready(function() {
    $("#ville_name").keyup(function() {
      $.ajax({
        type: "POST",
        url: "../controleur/ajaxRequestController.php",
        data: {
          keyword: $(this).val(),
          request: requestType
        },
        beforeSend: function() {
          $("#ville_name").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data) {
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#ville_name").css("background", "#FFF");
        }
      });
    });
  });

  // function utilisée par la vue retournée par l'ajax (TODO c'est pas terrible comme systeme, passer le nom de la fn en data ??)
  function selectValue(val, id) {
    $("#ville_name").val(val);
    $("#suggesstion-box").hide();

    $("#ville_id").val(7);
    console.log($("#ville_id"));
  }
</script>
