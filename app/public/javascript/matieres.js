const new_matieres = document.querySelector('.new_matieres');
const form_matieres = document.querySelector('.form_matieres');
const btnreset = document.querySelector('.btnreset');
const crois = document.querySelector('.crois');

if (new_matieres && form_matieres) {

    const openModal = () => form_matieres.classList.add('show');
    const closeModal = () => form_matieres.classList.remove('show');

    new_matieres.addEventListener('click', openModal);

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