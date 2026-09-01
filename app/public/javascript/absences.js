const AddAbcenses = document.querySelector('.AddAbcenses');
const formAbsences = document.querySelector('.formAbsences');
const btnreset = document.querySelector('.btnreset');
const crois = document.querySelector('.crois');

if (AddAbcenses && formAbsences) {
    const openModal = () => formAbsences.classList.add('show');
    const closeModal = () => formAbsences.classList.remove('show');

    AddAbcenses.addEventListener('click', () => {
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

