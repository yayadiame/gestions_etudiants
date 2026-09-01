<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'etudiant') {
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
    <!-- <link rel="stylesheet" href="../../public/css/form.css"> -->
</head>
<body>
    <main>
        <h2>Bienvenue dans votre espace étudiant</h2>
    </main>
    <script>
    window.addEventListener('pageshow', function (event) {
        const navigation = performance.getEntriesByType('navigation')[0];
        if (event.persisted || (navigation && navigation.type === 'back_forward')) {
            window.location.reload();
        }
    });
    </script>
</body>
</html>