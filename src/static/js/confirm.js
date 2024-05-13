// a transformer comme suit pour les différents champs
// function verifChampVideNom(){
//    verifierChampsVide('compte-mod-nom','btnConfirm);
// }

function verifierChampVide() {
    const champ = document.getElementById('compte-mod-nom');
    const bouton = document.getElementById('btnConfirm');

    champ.value.trim() === '' ? bouton.disabled = true : bouton.disabled = false;
}

//Ecouteur d'événement de champs vide
document.getElementById('compte-mod-nom').addEventListener('input', verifierChampVide);


function verifierEtOuvrirModal() {
    const champ = document.getElementById('compte-mod-nom');
    const modal = document.getElementById('confirmationModal');

    if (champ.checkValidity()) {
        $('#confirmationModal').modal('show');
    }
}


const form = document.getElementById('confirmForm');
const confirmButton = document.getElementById('confirmButton');

confirmButton.addEventListener('click', function() {
    form.submit();
});