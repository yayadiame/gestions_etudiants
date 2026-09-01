<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'prof') {
    header("Location: ../auth/form.php");
    exit();
}

require_once __DIR__ . '/../composants/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/dashboard_prof.css">
</head>
<body>
    <main class="main-prof">
        <div class="div-box">
            <div>
                <h2>Dashboard Enseignants</h2>
                <small>Bonjour <?= $_SESSION['nom'] ?> Voici un aperçu de votre activité.</small>
            </div>
            <button onclick="location.reload()"> <i class="fa-solid fa-arrows-rotate"></i> Recharger</button>
        </div>
        <div class="grid-prof">
            <div class="flexProf">
                <div>
                    <p>Classes</p>
                    <h2>03</h2>
                </div>
               <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="flexProf">
                <div>
                    <p>Etudiants</p>
                    <h2>03</h2>
                </div>
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="flexProf">
                <div>
                    <p>Matieres</p>
                    <h2>03</h2>
                </div>
                <i class="fa-solid fa-book-open"></i>
            </div>
        </div>
        <!-- ======= statistiques===== -->
         <div class="statistiques">

            <div class="stat-header">
                <div>
                    <h3>Statistiques</h3>
                    <p>Évolution des étudiants par matière</p>
                </div>
            </div>

            <div class="chart">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
             const matieres = [
                "Mathématiques",
                "Français",
                "Anglais"
            ];

            const nombres = [
                10,
                15,
                8
            ];
            new Chart(document.getElementById("myChart"), {
                type: "line",
                data: {
                    labels: matieres,
    
                    datasets: [{
                        label: "Étudiants",
                        data: nombres
                    }]
                }
            });
        </script>


    </main>
    <!-- <script>
    window.addEventListener('pageshow', function (event) {
        const navigation = performance.getEntriesByType('navigation')[0];
        if (event.persisted || (navigation && navigation.type === 'back_forward')) {
            window.location.reload();
        }
    });
    </script> -->
</body>
</html>