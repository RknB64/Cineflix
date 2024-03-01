<?php

$fields = [
//  libellé                     type
  ["Nom",                       "text"],
  ["Prénom",                    "text"],
  ["Date de naissance",         "text"],
  ["Adresse Postale",           "text"],
  ["Email",                     "email"],
  ["Téléphone",                 "text"],
  ["Mot de passe",              "password"],
  ["Retaper le mot de passe",   "password"]
];

?>

<div class="form-wrapper container-fluid">
  <form action="" method="post">
      <?php
        foreach ($fields as $field) {
          $id = str_replace(" ", "_", $field[0]);
      ?>
          <div class="form-group">
            <label for='<?= $id ?>'> <?= $field[0] ?> </label>
            <input class="form-control" type="<?$field[1]?>" id="<?= $id ?>">
          </div>
      <?php
        }
      ?>
  </form>
</div>

