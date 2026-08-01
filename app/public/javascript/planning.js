const new_planning = document.querySelector('.new_planning');
const form_planning = document.querySelector('.form_planning');
const resete = document.querySelector('.resete');
const crois = document.querySelector('.crois');

if (new_planning && form_planning) {

    const openModal = () => form_planning.classList.add('show');
    const closeModal = () => form_planning.classList.remove('show');

    new_planning.addEventListener('click', openModal);

    if (resete) {
        resete.addEventListener('click', (e) => {
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