<?php
session_start();
require_once (__DIR__ . "../../composants/nav.php");
require_once (__DIR__ . "../../composants/header.php");


require_once "../../models/notes.php";


$id_etudiant = $_SESSION["id"];
 
$notesModel = new Notes("", "", "", "");

$notEs = $notesModel->afficherNotesEtudiant($id_etudiant);
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
    <section class="mes_notes">
        <div  class="page-header">
            <h2>Gestions des notes</h2>
            <p>Consulter mes notes </p>
        </div>
            <table>
                <th>Nom du matiere</th>
                <th>devoir</th>
                <th>Examen</th>
                <th>Note</th>
                <?php foreach ($notEs as $note): ?>
            <tr>
                <td><?= htmlspecialchars($note["nom_matiere"]) ?></td>
                <td>
                    <?php if ($note["type_note"] === "devoir"): ?>
                        <?= htmlspecialchars($note["note"]) ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($note["type_note"] === "examen"): ?>
                        <?= htmlspecialchars($note["note"]) ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?= htmlspecialchars($note["note"]) ?>
                </td>
                </tr>
            <?php endforeach; ?>
            </table>
    </section>
</body>
</html>