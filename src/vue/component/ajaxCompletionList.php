<?php
// html utilisé pour créer une liste d'autocomplétion
// !! Deux variable doivent être définies dans la classe/controller qui 'include' se fichier :
//    @param $result -> une variable result doit être definie avec une liste d'objet de la bd
//    @param $colName -> une variable qui détermine quelle champ de l'objet est affiché doit être définie
//    @param $inputId -> id de l'input où l'élément selectionné sera ajouté
?>

<ul id="autocomplete-list" class="list-group">

    <?php if ($result === null) : ?>
        <li class="list-group-item list-group-item-dark" id="">
            Aucun résultat
        </li>
    <?php else : ?>

        <?php foreach ($result as $objet) : ?>
            <a href="#" onClick="selectValue('<?= $inputId ?>', '<?= $objet->$colName ?>', <?= $objet->id ?>)" class="focus-ring list-group-item list-group-item-dark" id='<?= $objet->id ?>' style='--bs-focus-ring-color: rgba(0,0,0, 0)'>
                <?= $objet->$colName; ?>
            </a>
        <?php endforeach; ?>

    <?php endif; ?>

</ul>



<script>
    document.querySelectorAll('.list-group-item').forEach(function(element) {
        element.addEventListener('mouseover', on);
        element.addEventListener('mouseout', out);
        element.addEventListener('focus', on);
        element.addEventListener('focusout', out);
    });

    function on(event) {
        /* event.target.style.backgroundColor = '#dbdbdb'; */
        event.target.classList.add('active');
    }

    function out(event) {
        event.target.classList.remove('active');
        event.target.style.backgroundColor = '';
    }
</script>
