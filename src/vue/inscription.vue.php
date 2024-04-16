<?php
// constantes pour manipuler les fields
const LABEL = UserRegister::LABEL;
const TYPE  = UserRegister::TYPE;
const NAME  = UserRegister::NAME;
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
          <label for='<?= $id ?>'> <?= $field[LABEL] ?> </label>
          <input class="form-control" type="<?= $field[TYPE] ?>" name="<?= $field[NAME] ?>" id="<?= $field[NAME] ?>" required autocomplete="off">
          <?php if ($field[NAME] === 'ville') : ?>
        <div  class="position-relative">
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
  let requestType = '<?php echo VilleAjax::AUTOCOMPLETE_REQUEST; ?>';

  $(document).ready(function() {
    $("#ville").keyup(function() {
      $.ajax({
        type: "POST",
        url: "../controleur/ajaxRequestController.php",
        data: {
          keyword: $(this).val(),
          request: requestType
        },
        beforeSend: function() {
          $("#ville").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data) {
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#ville").css("background", "#FFF");
        }
      });
    });
  });
  //To select a country name
  function selectCountry(val) {
    $("#ville").val(val);
    $("#suggesstion-box").hide();
  }

</script>
