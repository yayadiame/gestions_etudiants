<?php
require_once (__DIR__ . "../../composants/nav.php");
require_once (__DIR__ . "../../composants/header.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/classe.css">
</head>
<body>
    <div class="contenair_classe">
        <div class="cardAjout">
            <!-- <div class="color"></div>   -->
            <form action="" method="post">
                 <div class="flex">
                    <h4>Ajouter une classe</h4>
                    <p><strong class="crois">X</strong></p>
                 </div>
                <input type="text" name="classe" placeholder="Nom de la classe" required>
                <select name="niveau" id="niveau" required>
                    <option value="">-- Sélectionner un niveau --</option>
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                </select>
                <input type="text" name="filier" placeholder="Filier" required>
                <div class="button">
                    <button class="btnreset" >Annuler</button>
                    <button class="btnadd"type="submit">+ Nouvelle classe</button>
                </div>
            </form>
        </div>
        <div class="filtere">
            <input type="text" class="input_filter" placeholder="filter par nom ...">
            <button class="addClasse">add classes</button>
        </div>
        <div class="table">
        <table>
            <thead>
                <th>Nom de la classe</th>
                <th>Filier</th>
                <th>Niveau</th>
                <th>action</th>
            </thead>
            <tr>
                <td>3eme A</td>
                <td>Anglais</td>
                <td>L3</td>
                <td>
                    <button>modifier</button>
                    <button>supprimer</button>
                </td>
            </tr>
        </table>
    </div>
    </div>
</body>
<script src="../../public/javascript/classe.js"></script>
</html>
