<?php

// autoload doit être chargé quand on utilise ajax
require_once "../controleur/config.php";
require_once AUTOLOAD;

if (!empty($_POST["keyword"])) {
  $villeDao = new VilleBD();
  $result = $villeDao->autocomplete($_POST["keyword"]);

  if (!empty($result)) {
?>
    <ul id="country-list" class="list-group">
      <?php foreach ($result as $ville) : ?>
        <li onClick="selectCountry('<?php echo $ville; ?>');" class="list-group-item">
          <?php echo $ville; ?>
        </li>
      <?php endforeach; ?>
    </ul>
<?php
  } // end if not empty
}
?>
