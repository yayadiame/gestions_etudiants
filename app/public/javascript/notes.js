const form_notes = document.querySelector('.form_notes');
const btnAdd = document.querySelector('#btnAdd');
const crois = document.querySelector('.crois');
const reset = document.querySelector('.reset');

if (form_notes && btnAdd) {
    const openModal = () => {
        form_notes.classList.add('show');
    };

    const closeModal = () => {
        form_notes.classList.remove('show');
    };

    btnAdd.addEventListener('click', (e) => {
        e.preventDefault();
        openModal();
    });

    if (reset) {
        reset.addEventListener('click', (e) => {
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
