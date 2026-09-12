<?php
require_once(__DIR__ . "/nav.php");
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Déterminer l'URL de la photo de profil
$photoUrl = '../../public/profil.jpg';
if (!empty($_SESSION['photo'])) {
    $photoUrl = '../../' . ltrim($_SESSION['photo'], '/');
} elseif (!empty($_SESSION['id'])) {
    // essayer de récupérer depuis la table users via le modèle Profil
    $profilFile = __DIR__ . '/../../models/profil.php';
    if (file_exists($profilFile)) {
        require_once $profilFile;
        $profilModel = new Profil();
        $user = $profilModel->afficherProfil($_SESSION['id']);
        if ($user && !empty($user['photo'])) {
            $photoUrl = '../../' . ltrim($user['photo'], '/');
        }
    }
}
?>
<link rel="stylesheet" href="../../public/css/style.css">
<link rel="stylesheet" href="../../public/css/header.css">
<header>
    <div class="header">
        <h1></h1>
        <!-- <input id="input" type="text" placeholder="Chercher ...."> -->
        <div class="right">
            <!-- <p>gestions <br> etudiants</p> -->
            <img src="<?= htmlspecialchars($photoUrl) ?>" alt="Profil">
        </div>
    </div>
</header>