<?php
require_once __DIR__ . "../../composants/nav.php";
require_once __DIR__ . "../../composants/header.php";
require_once __DIR__ . "/../../models/notes.php";

//etudiant
require_once __DIR__ . "/../../models/etudiant.php";
$etudiant = new Etudiant("", "");
$etudiants = $etudiant->afficherEtudiants();

//matieres
require_once __DIR__ . "/../../models/matieres.php";
$matieresModels = new Matieres("", "", "");
$matieres =$matieresModels-> afficherMatieres();
//notes
$notesModels = new Notes("", "", "", "");
$limit = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$notEs = $notesModels->afficherNotes($limit, $offset);
$totalPages = max(1, (int) ceil($notesModels->compterNotes() / $limit));

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $limit;
    $notEs = $notesModels->afficherNotes($limit, $offset);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/notes.css">
</head>
<body>
    <section class="parti-notes">
         <div class="page-header">
            <h1>Gestion des notes</h1>
            <p>Consultez et gérez vos notes.</p>
        </div>
        <div class="filtres_notes">
            <input type="text" id="search" placeholder=" filtrer par .......">
            <button id="btnAdd"><i class="fa-solid fa-file-pen"></i> Creer Notes</button>
        </div>
        <div class="form_notes">
            <form action="../../controllers/NotesControllers.php" method="post">
            <div class="flex_crois">
                <h2>Ajouter une note</h2>
                <p class="crois">X</p>
            </div>
                <label>Etudiant</label>
                <select name="id_etudiant" id="">
                    <option value="">--Etudiants--</option>
                    <?php foreach ($etudiants as $students): ?>
                    <option value="<?= $students['id'] ?>">  <?= htmlspecialchars($students['nom'] ) ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Matieres</label>
                <select name="id_matiere" id="">
                    <option value="">--Matieres--</option>
                    <?php foreach ($matieres as $module): ?>
                    <option value="<?= $module['id'] ?>">  <?= htmlspecialchars($module['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Type de notes</label>
                <select name="type_note" id="">
                    <option value="">--type de notes--</option>
                    <option value="Devoir">Devoir</option>
                    <option value="Examen">Examen</option>
                </select>
                <label>Note</label>
                <input type="number" name="note" max="20" min="0" placeholder=" votre note est de : 15/20">
                <div class="flex-notes">
                    <button class="button" type="reset">Annuler</button>
                    <button type="submit">Ajouter un Notes</button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <th>Profil</th>
                <th>nom</th>
                <th>matiere</th>
                <th>type de Note</th>
                <th>Note</th>
                <th>Action</th>
            </thead>
            <?php foreach($notEs as $notes): ?>
            <tr>
                   <td><?php
                $nom = trim($notes['nom_etudiant']);
                $mots = explode(' ', $nom);

                if (count($mots) >= 2) {
                    $initiales = strtoupper(
                        substr($mots[0], 0, 1) .
                        substr($mots[1], 0, 1)
                    );
                } else {
                    $initiales = strtoupper(substr($nom, 0, 2));
                }
                ?>
                    <div class="avatar">
                        <?= htmlspecialchars($initiales) ?>
                    </div>
                </td>
                <td><?= $notes['nom_etudiant'] ?></td>
                <td><?= $notes['nom_matiere'] ?></td>
                <td><?= $notes['type_note'] ?></td>
                <td><?= $notes['note'] ?></td>
                <td class="flex-icones">
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../../controllers/NotesControllers.php?action=supprimer&id=<?= urlencode($notes['id']) ?>"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php if ($totalPages > 1): ?>
        <div class="pagination" aria-label="Pages des notes">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" aria-label="Page précédente">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            <?php endif; ?>
            <?php for ($numero = 1; $numero <= $totalPages; $numero++): ?>
                <a href="?page=<?= $numero ?>" class="<?= $numero === $page ? 'active' : '' ?>">
                    <?= $numero ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>" aria-label="Page suivante">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
</body>
<script src="../../public/javascript/notes.js"></script>
</html>