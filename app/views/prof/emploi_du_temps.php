<?php
// session_start();
require_once (__DIR__ . "../../composants/nav.php");
require_once (__DIR__ . "../../composants/header.php");
require_once __DIR__ . "/../../models/emploi_du_temps.php";

$limite = 2;
$page = max(1, (int) ($_GET['page'] ?? 1));
$debut = ($page - 1) * $limite;

$planningModels = new Planning("", "", "", "", "", "");

$plannings = $planningModels->afficherPlanning(null, $limite, $debut);
$nombrePages = max(1, (int) ceil($planningModels->compterPlanning() / $limite));
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
                    <option value=""> Toutes les jours</option>
                    <option value="1">Lundi</option>
                    <option value="2">Mardi</option>
                    <option value="3">Mercredi</option>
                    <option value="3">Jeudi</option>
                    <option value="3">Vendredi</option>
                    <option value="3">Samedi</option>
                </select>
                <button type="submit"> Filtrer</button>
                <button onclick="location.reload()">Réinitialiser</button>
            </form>
        </div>
        <div class="table-container">
        <table>
            <thead>
                <th>Jours</th>
                <th>Matieres</th>
                <th>Heur</th>
                <th>Heur</th>
                <th>Salle</th>
            </thead>
            <?php foreach($plannings as $Temps): ?>
            <tr>
                <td><?= $Temps['jour'] ?></td>
                <td><?= $Temps['matiere'] ?></td>
                <td><?= $Temps['heure_debut'] ?></td>
                <td><?= $Temps['heure_fin'] ?></td>
                <td><?= $Temps['classe'] ?></td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php if ($nombrePages > 1): ?>
        <nav class="pagination" aria-label="Pages des emplois du temps">
            <?php for ($numero = 1; $numero <= $nombrePages; $numero++): ?>
                <a href="?page=<?= $numero ?>" class="<?= $numero === $page ? 'active' : '' ?>"><?= $numero ?></a>
            <?php endfor; ?>
        </nav>
        <?php endif; ?>
    </section>
</body>
</html>