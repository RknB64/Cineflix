// Initialisation des variables
let champsNom = 'compte-mod-nom';
let btnNom = 'btn-mod-nom';
let champsPrenom = 'compte-mod-prenom';
let btnPrenom = 'btn-mod-prenom';
let champsEmail = 'compte-mod-mail';
let btnEmail = 'btn-mod-mail';
let champsToMod = null;
let form = null;

// Vérification des champs vides
function verifChampVideNom(){
    verifierChampVide(champsNom, btnNom);
}

function verifChampVidePrenom(){
    verifierChampVide(champsPrenom, btnPrenom);
}

function verifChampVideMail(){
    verifierChampVide(champsEmail, btnEmail);
}

function verifierChampVide(champs, btn) {
    const champ = document.getElementById(champs);
    const bouton = document.getElementById(btn);

    champ.value.trim() === '' ? bouton.disabled = true : bouton.disabled = false;
}

// Ecouteur d'événement de champs vide
document.getElementById(champsNom).addEventListener('input', verifChampVideNom);
document.getElementById(champsPrenom).addEventListener('input', verifChampVidePrenom);
document.getElementById(champsEmail).addEventListener('input', verifChampVideMail);

// Ouverture modal de confirmation
function confirmationModalNom(){
    ouvrirModal(champsNom);
}

function confirmationModalPrenom(){
    ouvrirModal(champsPrenom);
}

function confirmationModalMail(){
    ouvrirModal(champsEmail);
}

function ouvrirModal(champs) {
    const champ = document.getElementById(champs);
    champsToMod = champs;
    console.log(champsToMod)
    switch (champsToMod) {
        case champsNom:
            form = 'formModNom';
            break;
        case champsPrenom:
            form = 'formModPrenom';
            break;
        case champsEmail:
            form = 'formModMail';
            break;
        default:
            form = null;
            break;
    }
    console.log(form)

    if (champ.checkValidity()) {
        $('#confirmationModal').modal('show');
        envoiForm();
    }
}

// Envoi du formulaire
function envoiForm(){
    const formulaire = document.getElementById(form);
    const confirmButton = document.getElementById('confirmButton');
    
    confirmButton.addEventListener('click', function() {
        formulaire.submit();
    });
}

