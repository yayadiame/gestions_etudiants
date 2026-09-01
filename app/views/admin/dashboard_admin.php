<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/form.php");
    exit();
}

// Inclure le contrôleur pour récupérer les données
require_once __DIR__ . "/../../controllers/dashboardControllers.php";
$controller = new DashboardController();

// Récupérer les données via le modèle
$model = new DashboardAdmin();
$totalEtudiants = $model->totalEtudiants();
$totalProfesseurs = $model->totalProfesseurs();
$totalClasses = $model->totalClasses();
$derniersEtudiants = $model->derniersEtudiants();
$derniersProfesseurs = $model->derniersProfesseurs();

require_once __DIR__ . "/../composants/nav.php";
require_once __DIR__ . "/../composants/header.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/dashboard_admin.css">
</head>
<body>
    <section class="class-dashboard">
        <div class="div-lefts">
            <div>
                <h3>Dashboard Admin</h3>
                <small>Bonjour <?= $_SESSION['nom'] ?> Voici un aperçu de votre activité.</small>
            </div>
            <button onclick='location.reload()'> <i class="fa-solid fa-arrows-rotate"></i> Recharger</button>
        </div>
        <div class="div-grids">
            <div class="bords">
                <div>
                    <h5>Total étudiants</h5>
                    <p><?= $totalEtudiants ?></p>
                </div>
                <div class="icon"><i class="fas fa-user-graduate"></i> </div>
            </div>
            <div class="bords">
                <div>
                    <h5>Total classes</h5>
                    <p><?= $totalClasses ?></p>
                </div>
                <div class="icon"><i class="fas fa-school"></i></div>
            </div>
            <div class="bords">
                <div>
                    <h5>Total professeurs</h5>
                    <p><?= $totalProfesseurs ?></p>
                </div>
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i> </div>
            </div>
        </div>
        <!-- ======= diagrammes de mon school ==== -->
         <?php
            $total = $totalEtudiants + $totalProfesseurs + $totalClasses;

            $pourcentageProf = $total > 0
                ? ($totalProfesseurs / $total) * 100
                : 0;

            $pourcentageClasses = $total > 0
                ? ($totalClasses / $total) * 100
                : 0;

            $pourcentageEtudiants = $total > 0
                ? ($totalEtudiants / $total) * 100
                : 0;
            ?>
         <!-- le php du diagrammes -->
        <div class="graphique">
            <h2>Statistiques de l'école</h2>
            <div class="barre">
                <div class="nom">
                    Professeurs : <?= $totalProfesseurs ?>
                </div>
                <div class="barre-fond">
                    <div
                        class="barre-remplie"
                        style="width: <?= $pourcentageProf ?>%;">
                    </div>
                </div>
            </div>
            <div class="barre">
                <div class="nom">
                    Classes : <?= $totalClasses ?>
                </div>
                <div class="barre-fond">
                    <div
                        class="barre-remplie"
                        style="width: <?= $pourcentageClasses ?>%;">
                    </div>
                </div>
            </div>
            <div class="barre">
                <div class="nom">
                    Étudiants : <?= $totalEtudiants ?>
                </div>
                <div class="barre-fond">
                    <div
                        class="barre-remplie"
                        style="width: <?= $pourcentageEtudiants ?>%;">
                    </div>
                </div>
            </div>
        </div>
        <h2>Dernieres Etudiants</h2>
        <table>
            <thead>
                <th>ID</th>
                <th>profil</th>
                <th>nom</th>
                <th>email</th>
            </thead>
            <?php foreach ($derniersEtudiants as $etudiant): ?>
            <tr>
                <td><?= $etudiant['id'] ?></td>
                <td>👤</td>
                <td><?= $etudiant['nom'] ?></td>
                <td><?= $etudiant['email'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br><br><br>
        <h2>Dernieres Enseignants</h2>
        <table>
            <thead>
                <th>ID</th>
                <th>profil</th>
                <th>nom</th>
                <th>email</th>
            </thead>
            <?php foreach($derniersProfesseurs as $prof): ?>
            <tr>
                <td> <?= $prof['id'] ?></td>
                <td>👤</td>
                <td> <?= $prof['nom'] ?></td>
                <td> <?= $prof['email'] ?></td>
            </tr>
             <?php endforeach; ?>
        </table>
    </section>
<script>
// window.addEventListener('pageshow', function (event) {
//     const navigation = performance.getEntriesByType('navigation')[0];
//     if (event.persisted || (navigation && navigation.type === 'back_forward')) {
//         window.location.reload();
//     }
// });
</script>
</body>
</html>