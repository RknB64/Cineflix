<?php

// autoload doit être chargé quand on utilise ajax
require_once "../../controleur/config.php";
require_once AUTOLOAD;

if (!empty($_POST["keyword"])) {
  $villeDao = new VilleBD();
  $result = $villeDao->selectLike($_POST["keyword"], "nom", "nom", 6);

  if (!empty($result)) {
?>
    <ul id="country-list" class="list-group">
      <?php foreach ($result as $ville) : ?>
        <li onClick="selectCountry('<?php echo $ville->$nom; ?>');" class="list-group-item">
          <?php echo $ville->nom; ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <script>
      document.querySelectorAll('.list-group-item').forEach(function(element) {
        element.addEventListener('mouseover', hover);
        element.addEventListener('mouseout', out);
      });

      function hover(event) {
        console.log(event.target);
        event.target.style.backgroundColor = '#dbdbdb';
      }
      function out(event) {
        console.log(event.target);
        event.target.style.backgroundColor = '#FFF';
      }
    </script>


<?php
  } // end if not empty
}
?>
