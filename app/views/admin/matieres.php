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
    <link rel="stylesheet" href="../../public/css/matieres.css">
</head>
<body>
    <section class="parti_matieres">
        <div class="flex-h2">
            <h3>Tableau des Matieres</h3>
            <button class="new_matieres">Creer Matieres</button>
        </div>
        <div class="form_matieres">
            <form action="">
                <div class="flex_modal">
                    <h3>Ajouter une matière</h3>
                    <p class="crois">X</p>
                </div>
                <input class="input" type="text" placeholder="Ex:html" required>
                <select name="" id="">
                    <option value="">--prof--</option>
                    <option value="">Moussa</option>
                    <option value="">Souleyemane</option>
                </select>
                <input type="number" name="coeffe" placeholder="Ex :coef 4" required min="1" max="10">
                <div class="flex_btn">
                    <button class="btnreset">Annulere</button>
                    <button class="btnadd" type="submit">Creer Matieres</button>
                </div>
            </form>
        </div>
    </section>
</body>
<script src="../../public/javascript/matieres.js"></script>
</html>