const search = document.getElementById("search");
const statutFilter = document.getElementById("statutFilter");

function filtrerAbsences() {

    const recherche = search.value.toLowerCase();
    const statut = statutFilter.value;

    const lignes = document.querySelectorAll(
        "#absenceTable tbody tr"
    );

    lignes.forEach(ligne => {

        const texte = ligne.textContent.toLowerCase();

        const ligneStatut =
            ligne.dataset.statut;

        const correspondRecherche =
            texte.includes(recherche);

        const correspondStatut =
            statut === "" ||
            ligneStatut === statut;

        if (
            correspondRecherche &&
            correspondStatut
        ) {

            ligne.style.display = "";

        } else {

            ligne.style.display = "none";

        }

    });
}

search?.addEventListener(
    "input",
    filtrerAbsences
);

statutFilter?.addEventListener(
    "change",
    filtrerAbsences
);
