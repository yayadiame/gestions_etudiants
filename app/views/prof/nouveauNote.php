<?php
session_start();
require_once (__DIR__ . "../../composants/nav.php");
require_once (__DIR__ . "../../composants/header.php");
require_once __DIR__ . "/../../models/notes.php";

//etudiant
require_once __DIR__ . "/../../models/etudiant.php";
$etudiant = new Etudiant("", "");
$etudiants = $etudiant->afficherEtudiants();

//matieres
require_once __DIR__ . "/../../models/matieres.php";
$matieresModels = new Matieres("", "", "");
$matieres =$matieresModels-> afficherMatieresProf($_SESSION['id']);
//notes
$notesModels = new Notes("", "", "", "");
$notEs = $notesModels->afficherNotesProf($_SESSION['id']);
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
            <p>Consultez et gérez les notes de vos étudiants.</p>
        </div>
        <div class="filtres_notes">
            <input type="text" placeholder=" filtrer par .......">
            <button id="btnAdd">Creer Notes</button>
        </div>
        <div class="form_notes">
            <form action="../../controllers/NotesControllers.php" method="post">
                <input type="hidden" name="redirect" value="prof/nouveauNote.php">
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
        <div class="table-container">
        <table>
            <thead>
                <th>Profil</th>
                <th>nom</th>
                <th>matiere</th>
                <th>Devoir</th>
                <th>Examen</th>
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
                <td>
                    <?php if ($notes["type_note"] === "devoir"): ?>
                        <?= htmlspecialchars($notes["note"]) ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($notes["type_note"] === "examen"): ?>
                        <?= htmlspecialchars($notes["note"]) ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?= $notes['note'] ?></td>
                <td>
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../../controllers/NotesControllers.php?action=supprimer&id=<?= urlencode($notes['id']) ?>"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </section>
</body>
<script src="../../public/javascript/notes.js"></script>
<script src="../../public/javascript/filtrer_absences.js"></script>
</html>