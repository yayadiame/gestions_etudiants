const addEtudiant = document.querySelector('.addEtudiant');
const formEtudiant = document.querySelector('.form_etudiant');
const btnreset = document.querySelector('.btnreset');
const crois = document.querySelector('.crois_X');

if (addEtudiant && formEtudiant) {
    addEtudiant.addEventListener('click', function () {
        formEtudiant.classList.add('show');
    });

    if (btnreset) {
        btnreset.addEventListener('click', function (e) {
            e.preventDefault();
            formEtudiant.classList.remove('show');
        });
    }

    if (crois) {
        crois.addEventListener('click', function (e) {
            e.preventDefault();
            formEtudiant.classList.remove('show');
        });
    }
}
//filtrage 
const search = document.getElementById("search");
const table = document.querySelector("table");

search.addEventListener("input", function () {

    const valeur = search.value.toLowerCase();
    const lignes = table.querySelectorAll("tr");

    lignes.forEach(function (ligne) {

        const nom = ligne.querySelector("td");

        // On ignore la ligne des titres
        if (nom) {
            if (nom.textContent.toLowerCase().includes(valeur)) {
                ligne.style.display = "";
            } else {
                ligne.style.display = "none";
            }
        }
    });
});
