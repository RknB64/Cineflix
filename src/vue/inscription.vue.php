<?php

$fields = [
  //  label                       type          row
  ["Prénom",                    "text",         1],
  ["Nom",                       "text",         1],
  ["Email",                     "email",        1],
  ["Adresse Postale",           "text",         2],
  ["Date de naissance",         "text",         2],
  /* ["Téléphone",                 "text",         3], */
  ["Mot de passe",              "password",     4],
  ["Retaper le mot de passe",   "password",     4]
];

?>

<div class="form-wrapper ">
  <form action="" method="post">
    
    <div class="form-part">
        <label for='test'>Test</label>
        <input class="form-control" type="text" id="test">

        <label for='test2'>Test2</label>
        <input class="form-control" type="text" id="test2">
    </div>

    <?php foreach ($fields as $field) : ?>
      <?php $id = str_replace(" ", "_", $field[0]); ?>
 
      <div class="form-group">
        <label for='<?= $id ?>'> <?= $field[0] ?> </label>
        <input class="form-control" type="<?$field[1]?>" id="<?= $id ?>">
      </div>
    <?php endforeach; ?>

  </form>
</div>
