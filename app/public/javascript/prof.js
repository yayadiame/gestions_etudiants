const addprof = document.querySelector('.addprof');
const formProf = document.querySelector('.form_prof');
const btnreser = document.querySelector('.btnreser');
const crois = document.querySelector('.crois');

if (addprof && formProf) {
    const openModal = () => formProf.classList.add('show');
    const closeModal = () => formProf.classList.remove('show');

    addprof.addEventListener('click', () => {
        openModal();
    });

    if (btnreser) {
        btnreser.addEventListener('click', (e) => {
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







// const addprof = document.querySelector(".addprof");
// const formProf = document.querySelector(".form_prof");
// const btnreser = document.querySelector(".btnreser");
// const crois = document.querySelector(".crois");

// addprof.addEventListener("click", () => {
//     formProf.classList.add("show");
// });

// btnreser.addEventListener("click", (e) => {
//     e.preventDefault();
//     formProf.classList.remove("show");
// });

// crois.addEventListener("click", (e) => {
//     e.preventDefault();
//     formProf.classList.remove("show");
// });