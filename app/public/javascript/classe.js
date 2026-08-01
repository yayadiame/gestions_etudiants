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