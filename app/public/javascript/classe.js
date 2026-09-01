const addClasse = document.querySelector('.addClasse');
const cardAjout = document.querySelector('.cardAjout');
const btnreset = document.querySelector('.btnreset');
const crois = document.querySelector('.crois');

if (addClasse && cardAjout) {
    const openModal = () => cardAjout.classList.add('show');
    const closeModal = () => cardAjout.classList.remove('show');

    addClasse.addEventListener('click', () => {
        openModal();
    });

    if (btnreset) {
        btnreset.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal();
        });
    }

    if (crois) {
        crois.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal();
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
