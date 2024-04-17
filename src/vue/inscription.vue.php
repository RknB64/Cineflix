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
              <div class="position-absolute" id="suggesstion-box-ville"></div>
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

<!-- Ajout de l'ajax pour autocompléter les villes -->
<script src="/static/js/ajaxAutocompleteVille.js"></script>
<script>
  autocompleteVille();
</script>
