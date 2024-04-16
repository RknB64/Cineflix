<?php
  // html utilisé pour créer une liste d'autocomplétion
  // !! Deux variable doivent être définies dans la classe/controller qui 'include' se fichier :
  //    @param $result -> une variable result doit être definie avec une liste d'objet de la bd
  //    @param $colName -> une variable qui détermine quelle champ de l'objet est affiché doit être définie
?>

<ul id="country-list" class="list-group">
    <?php foreach ($result as $objet) : ?>
        <li onClick="selectCountry('<?= $objet->$colName ?>')" class="list-group-item">
            <?= $objet->$colName; ?>
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
