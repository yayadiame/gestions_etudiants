<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/form.css">
</head>
<body>
<div class="contenair">
    <div class="lefter_login">
        <div class="overlay">
            <i class="fa-solid fa-user-graduate"></i>
            <h1>Bienvenue dans notre Plate-forme</h1>
            <p>Connectez-vous pour accéder à votre espace étudiant.</p>
        </div>
    </div>
    <form action="../../controllers/UserControllers.php" method="post">
        <h2>Connexion</h2>
        <div class="input-box">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" placeholder="Votre adresse email" required>
        </div>
        <div class="input-box">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Votre mot de passe" required>
        </div>
        <span class="password_forget"><a href="../forget-password.php">Mot de passe oublié ?</a></span>
        <button type="submit"> Se connecter <i class="fa-solid fa-arrow-right"></i></button>
        <br>
        <?php if (isset($_SESSION['erreur'])): ?>
            <p class="message-erreur" style="color:red; text-Align:center">
                <?= htmlspecialchars($_SESSION['erreur']) ?>
            </p>
            <?php unset($_SESSION['erreur']); ?>
        <?php endif; ?>
    </form>
</div>
</body>
</html>