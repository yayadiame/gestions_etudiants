<?php

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, no-store, no-cache, must-revalidate", false);
header("Pragma: no-cache");

require_once __DIR__ . '/../../models/dashboard_prof.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'prof') {
    header("Location: ../auth/form.php");
    exit();
};

// ID du professeur connecté
$id_prof = $_SESSION['id'];

$dashboard = new DashboardProf();

// Récupération des statistiques
$totalEtudiant = $dashboard->nmbrEtudiant($id_prof);
$totalClasses = $dashboard->NmbrClasses($id_prof);
$totalMatieres = $dashboard->NmbrMatieres($id_prof);
$totalNotes = $dashboard->NmbrNotes($id_prof);
$mesClasses = $dashboard->mesClasses($id_prof);

// Prochains cours
$prochainsCours = $dashboard->prochainsCours($id_prof);

require_once __DIR__ . '/../composants/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/dashboard_prof.css">
</head>
<body>
    <main class="main-prof">
        <div class="div-box">
            <div>
                <h2>Dashboard Enseignants</h2>
                <small>Bonjour <?= htmlspecialchars($_SESSION['nom'] ?? '') ?>, voici un aperçu de votre activité.</small>
            </div>
            <button onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Recharger</button>
        </div>
        <div class="grid-prof">
            <div class="flexProf">
                <div>
                    <p>Classes</p>
                    <h2><?= htmlspecialchars((string)$totalClasses) ?></h2>
                </div>
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>

            <div class="flexProf">
                <div>
                    <p>Etudiants</p>
                    <h2><?= htmlspecialchars((string)$totalEtudiant) ?></h2>
                </div>
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="flexProf">
                <div>
                    <p>Notes</p>
                    <h2><?= htmlspecialchars((string)$totalNotes) ?></h2>
                </div>
                <i class="fa-solid fa-user-graduate"></i>
            </div>

            <div class="flexProf">
                <div>
                    <p>Matieres</p>
                    <h2><?= htmlspecialchars((string)$totalMatieres) ?></h2>
                </div>
                <i class="fa-solid fa-book-open"></i>
            </div>
        </div>

        <div class="dashboard-card">
            <h3 class="hh2"> MES CLASSES</h3>
            <div class="classes-list">
                            <?php if (!empty($mesClasses)): ?>
                                <?php foreach ($mesClasses as $classe): ?>
                  <div class="classe-item">
                      <span class="classe-name">
                          <?= htmlspecialchars($classe['nom']) ?>
                      </span>
                      <span class="classe-eleves">
                          <?= (int)$classe['total_eleves'] ?> élèves
                      </span>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                  <p>Aucune classe attribuée.</p>
              <?php endif; ?>
            </div>
        </div>
        <h2 class="hh2"> Mes prochains cours</h2>
        <table>
            <thead>
                <tr>
                    <th>Classe</th>
                    <th>Jour</th>
                    <th>Heure début</th>
                    <th>Heure fin</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($prochainsCours)): ?>
                <?php foreach ($prochainsCours as $cours): ?>
                    <tr>
                        <td><?= htmlspecialchars($cours['nom_classe']) ?></td>
                        <td><?= htmlspecialchars($cours['jour']) ?></td>
                        <td><?= htmlspecialchars($cours['heure_debut']) ?></td>
                        <td><?= htmlspecialchars($cours['heure_fin']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">
                        Aucun prochain cours.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table> 

    </main>
</body>
</html>