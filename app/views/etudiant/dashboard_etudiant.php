<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once __DIR__ . '/../../models/dashboard_etudiant.php';
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'etudiant') {
    header("Location: ../auth/form.php");
    exit();
}

require_once __DIR__ . '/../composants/header.php';

$id_etudiant = $_SESSION['id'];

$dashboard = new DashboardEtudiant();

$totalMatieres = $dashboard->NmbrMatieres($id_etudiant);
$totalAbsences = $dashboard->NmbrAbsences($id_etudiant);
$prochainCours = $dashboard->prochainsCours($id_etudiant);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/dashboard_etudiant.css">
</head>
<body>
    <main class="mainEtudiant">
       <div class="div-box-etudiant">
            <div>
                <h2>Dashboard Etudiants</h2>
                <small>Bonjour <?= htmlspecialchars($_SESSION['nom'] ?? '') ?>, voici un aperçu de votre activité.</small>
            </div>
            <button onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Recharger</button>
        </div>
        <div class="grid-etudiant">
            <div class="boX">
                <div>
                    <p>Matieres</p>
                    <h3><?= htmlspecialchars((string) $totalMatieres) ?></h3>
                </div>
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="boX">
                <div>
                    <p>Absences</p>
                    <h3><?= htmlspecialchars((string)$totalAbsences) ?></h3>
                </div>
                <i class="fa-solid fa-user-slash"></i>
            </div>
        </div>
        <div class="last">
             <?php if (!empty($prochainCours)): ?>
            <h2>Prochain Cours</h2>
            <table>
                <thead>
                    <th>Jour</th>
                    <th>Matiere</th>
                    <th>heure_debut</th>
                    <th>heure_fin</th>
                    <th>prof</th>
                </thead>
                    <table>
                        <thead>
                            <th>Jour</th>
                            <th>Matiere</th>
                            <th>heure_debut</th>
                            <th>heure_fin</th>
                            <th>prof</th>
                        </thead>
                        <?php foreach ($prochainCours as $cours): ?>
                        <tr>
                             <td><?= htmlspecialchars($cours['jour'] ?? '') ?></td>
                             <td><?= htmlspecialchars($cours['nom_matiere'] ?? '') ?></td>
                             <td><?= htmlspecialchars($cours['heure_debut'] ?? '') ?></td>
                             <td><?= htmlspecialchars($cours['heure_fin'] ?? '') ?></td>
                             <td><?= htmlspecialchars($cours['nom_prof'] ?? '') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p style="text-Align: center; color: #2b376b">Aucun cours n'est prévu pour cette journée.</p>
                <?php endif; ?>
        </div>
        <div class="slow-actions  last">
            <h2>Actions rapides</h2>
            <div class="rapide-actions">
                <a href="../../views/etudiant/mes_notes.php"><i class="fa-solid fa-chart-line"></i> Voir mes notes</a>
                <a href="../../views/etudiant/mon_planning.php"><i class="fa-solid fa-calendar-days"></i> Mon emploi du temps</a> 
                <a href="../../views/etudiant/mes_absences.php"><i class="fa-solid fa-user-slash"></i> Mes absences</a>
                <a href="../../views/etudiant/profil.php"><i class="fa-solid fa-gear"></i> Modifier mon profil</a>
            </div>
        </div>
    </main>
</body>
</html>