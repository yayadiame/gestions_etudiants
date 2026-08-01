<?php
require_once (__DIR__ . "../../composants/nav.php");
require_once (__DIR__ . "../../composants/header.php");
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
        <div class="filtres_notes">
            <input type="text" placeholder=" filtrer par .......">
            <button id="btnAdd">Creer Notes</button>
        </div>
        <div class="form_notes">
            <form action="" method="post">
            <div class="flex_crois">
                <h2>Ajouter une note</h2>
                <p class="crois">X</p>
            </div>
                <label>Etudiant</label>
                <select name="" id="">
                    <option value="">--Etudiant--</option>
                    <option value="">adama</option>
                    <option value="">yaya</option>
                </select>
                <label>Matieres</label>
                <select name="" id="">
                    <option value="">--Matieres--</option>
                    <option value="">Algorithme</option>
                    <option value="">html</option>
                </select>
                <label>Type de notes</label>
                <select name="" id="">
                    <option value="">--type de notes--</option>
                    <option value="">Devoir</option>
                    <option value="">Examen</option>
                </select>
                <label>Note</label>
                <input type="number" max="20" min="0" placeholder=" votre note est de : 15/20">
                <div class="flex-notes">
                    <button class="reset" type="reset">Annuler</button>
                    <button type="submit">Ajouter un Notes</button>
                </div>
            </form>
        </div>
    </section>
</body>
<script src="../../public/javascript/notes.js"></script>
</html>