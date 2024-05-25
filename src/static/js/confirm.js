// Initialisation des variables
const champsNom = 'compte-mod-nom';
const btnNom = 'btn-mod-nom';
const docChampsNom = document.getElementById(champsNom);
const champsPrenom = 'compte-mod-prenom';
const btnPrenom = 'btn-mod-prenom';
const docChampsPrenom = document.getElementById(champsPrenom);
const champsEmail = 'compte-mod-mail';
const btnEmail = 'btn-mod-mail';
const docChampsMail = document.getElementById(champsEmail);
const champMdp = 'compte-mod-mdp';
const confMdp = 'compte-conf-mdp';
const btnMdp = 'btn-mod-mdp';
const docChampsMdp = document.getElementById(confMdp);
const checkSupp = 'supp-compte-check';
const btnSupp = 'btn-supp-compte';
const docChampsSupp = document.getElementById(checkSupp);
let champsToMod = null;
let form = null;

const btnAchatStream = 'btn-achat-stream';

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

function verifChampVideMdp(){
    const champ = document.getElementById(champMdp);
    const champConf = document.getElementById(confMdp)
    const bouton = document.getElementById(btnMdp);

    champ.value.trim() === '' && champConf.value.trim() === '' ? bouton.disabled = true : bouton.disabled = false;
}

function verifierChecked() {
    const champ = document.getElementById(checkSupp);
    const bouton = document.getElementById(btnSupp);

    champ.checked ? bouton.disabled = false : bouton.disabled = true;
}


// Ecouteurs d'événement de champs vide
if (docChampsNom && docChampsPrenom && docChampsMail && docChampsMdp && docChampsSupp){
    docChampsNom.addEventListener('input', verifChampVideNom);
    docChampsPrenom.addEventListener('input', verifChampVidePrenom);
    docChampsMail.addEventListener('input', verifChampVideMail);
    docChampsMdp.addEventListener('input', verifChampVideMdp);
    docChampsSupp.addEventListener('input', verifierChecked);
}

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

function confirmationModalMdp(){
    ouvrirModal(champMdp);
}

function confirmationModalSupp(){
    ouvrirModal(checkSupp);
}

function confirmationModalAchatStream(){
    ouvrirModal(btnAchatStream);
}

function ouvrirModal(champs) {
    const champ = document.getElementById(champs);
    champsToMod = champs;
    
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
        case champMdp:
            form = 'formModMdp';
            break;
        case checkSupp:
            form = 'formSuppCompte';
            break;
        case btnAchatStream:
            form = 'formulaire-streaming';
            break;
        default:
            form = null;
            break;
    }

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

