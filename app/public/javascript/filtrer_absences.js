function filtrer() {

    const recherche = document.getElementById("search").value.toLowerCase();
    const statut = document.getElementById("statutFilter").value;

    const cartes = document.querySelectorAll(".absence-card");

    cartes.forEach(carte => {

        const nom = carte.dataset.nom.toLowerCase();
        const statutCarte = carte.dataset.statut;

        const correspondNom = nom.includes(recherche);
        const correspondStatut = statut === "" || statutCarte === statut;

        if (correspondNom && correspondStatut) {
            carte.style.display = "block";
        } else {
            carte.style.display = "none";
        }
    });
}