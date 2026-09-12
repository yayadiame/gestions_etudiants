<?php
session_start();

$error = $_SESSION["error"] ?? "";
$success = $_SESSION["success"] ?? "";

unset($_SESSION["error"], $_SESSION["success"]);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../public/css/forgetPassword.css">
</head>
<body>
    <div class="container">
        <h2>Mot de passe oublié ?</h2>
        <p class="description">
            Entrez votre adresse email pour réinitialiser votre mot de passe.
        </p>

        <?php if (!empty($error)) : ?>
            <div style="margin-bottom: 15px; background: #fdeaea; color: #b42318; padding: 10px; border-radius: 7px; font-size: 14px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div style="margin-bottom: 15px; background: #e8f7ee; color: #1f7a3c; padding: 10px; border-radius: 7px; font-size: 14px;">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form action="../controllers/forgetPasswordControllers.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Exemple : yaya@gmail.com" required>
            <button type="submit">Envoyer</button>
        </form>
        <a href="auth/form.php" class="retour">← Retour à la connexion</a>
    </div>
</body>
</html>