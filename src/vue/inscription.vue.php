<?php

$fields = [
  ["Nom"],
  ["Prénom"],
  ["Date de naissance"],
  ["Adresse Postale"],
  ["Email"],
  ["Téléphone"],
  ["Mot de passe"],
  ["Retaper le mot de passe"]
];

?>

<div class="form-wrapper">
  <form action="" method="post">
      <?php
        foreach ($fields as $field) {
          $id = str_replace(" ", "_", $field[0]);
      ?>
          <div class="form-group">
            <label for='<?= $id ?>'> <?= $field[0] ?> </label>
            <input class="form-control" type='text' id="<?= $id ?>">
          </div>
      <?php
        }
      ?>
  </form>
</div>
