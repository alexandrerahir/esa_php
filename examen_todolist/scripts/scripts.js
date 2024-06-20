// Modal ajout d'un groupe
var ajoutGroupe = document.getElementsByClassName("ajoutGroupe")[0];

var boutonAjoutGroupe = document.getElementsByClassName("boutonAjouterGroupe")[0];
var boutonAnnulerAjoutGroupe = document.getElementsByClassName("annulerGroupe")[0];

boutonAjoutGroupe.onclick = function() {
    ajoutGroupe.style.display = "flex";
}

boutonAnnulerAjoutGroupe.onclick = function() {
    ajoutGroupe.style.display = "none";
}



// Modal ajout d'une tache
var ajoutTache = document.getElementsByClassName("ajoutTache")[0];

var boutonAjoutTache = document.getElementsByClassName("boutonAjouterTache")[0];
var boutonAnnulerAjoutTache = document.getElementsByClassName("annulerTache")[0];

boutonAjoutTache.onclick = function() {
    ajoutTache.style.display = "flex";
}

boutonAnnulerAjoutTache.onclick = function() {
    ajoutTache.style.display = "none";
}



// Modal modifier tâche
function modalModifierTache(groupe, tache) {
    document.getElementsByClassName("modifierTache")[0].style.display = "flex";
    document.getElementById('ancienGroupe').value = groupe;
    document.getElementById('ancienNomTache').value = tache;
    document.querySelector('#modifierForm select[name="nomGroupe"]').value = groupe;
    document.querySelector('#modifierForm input[name="nomTache"]').value = tache;
}