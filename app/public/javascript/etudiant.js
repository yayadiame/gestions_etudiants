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