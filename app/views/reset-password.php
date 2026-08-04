<?php
session_start();
require_once __DIR__ . '/../models/etudiant.php';
require_once __DIR__ . '/../models/prof.php';

$token = $_GET['token'] ?? "";
$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = trim($_POST['token'] ?? "");
    $password = trim($_POST['password'] ?? "");

    if (empty($token) || empty($password)) {
        $message = "Le token ou le mot de passe est manquant.";
        $messageType = "error";
    } else {
        $etudiant = new Etudiant('', '');
        $result = $etudiant->definirMotDePasse($token, $password);

        if ($result === true) {
            $message = "Mot de passe mis à jour avec succès. Vous pouvez maintenant vous connecter.";
            $messageType = "success";
        } else {
            $message = $result;
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Changer le mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2b376b;
            margin-bottom: 25px;
        }

        label {
            font-size: 15px;
            color: #333;
        }

        input {
            width: 100%;
            height: 40px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 0 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            height: 42px;
            background: #2b376b;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #1d2650;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            font-size: 14px;
        }

        .message.success {
            background: #e8f7ee;
            color: #1f7a3c;
        }

        .message.error {
            background: #fdeaea;
            color: #b42318;
        }

        .link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2b376b;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer un nouveau mot de passe</h2>
         <?php if (!empty($message)) : ?>
            <div class="message <?= htmlspecialchars($messageType) ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <label>Nouveau mot de passe :</label>
            <input type="password" name="password" required>
            <button type="submit">Changer le mot de passe</button>
        </form>
        <?php if ($messageType === 'success') : ?>
            <a class="link" href="auth/form.php">Se connecter</a>
        <?php endif; ?>
    </div>
</body>
</html>