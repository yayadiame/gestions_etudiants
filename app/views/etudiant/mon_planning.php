<?php
// session_start();
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
    <link rel="stylesheet" href="../../public/css/planning.css">
</head>
<body>
    <section class="planning-etudiant">
        <div class="filtre_flex">
            <h3>consulter mon emploi du temps</h3>
            <form method="GET" class="filter-form">
                <select name="matiere">
                    <option value=""> Toutes les matières</option>
                    <option value="1">PHP</option>
                    <option value="2">JavaScript</option>
                    <option value="3">Base de données</option>
                </select>
                <button type="submit"> Filtrer</button>
                <button onclick="location.reload()">Réinitialiser</button>
            </form>
        </div>
        <table>
            <thead>
                <th>Jours</th>
                <th>Matieres</th>
                <th>Heur debut</th>
                <th>Heur fin</th>
                <th>Salle</th>
                <th>Prof</th>
            </thead>
            <tr>
                <td>lundi</td>
                <td>javascript</td>
                <td>08h-00</td>
                <td>11h-00</td>
                <td>A</td>
                <td>Moussa</td>
            </tr>
        </table>
    </section>
</body>
</html>