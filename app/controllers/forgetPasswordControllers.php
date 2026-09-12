<?php

require_once __DIR__ . "/../models/etudiant.php";
require_once __DIR__ . "/../../config/mail.php";
session_start();

class ForgotPasswordController
{
    public function envoyerLien()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ../views/forget-password.php");
            exit();
        }

        $email = trim($_POST["email"] ?? "");

        if (empty($email)) {
            $_SESSION["error"] = "Veuillez entrer votre email.";
            header("Location: ../views/forget-password.php");
            exit();
        }

        $etudiant = new Etudiant(null, null);
        $user = $etudiant->trouverParEmail($email);

        if (!$user) {
            $_SESSION["error"] = "Aucun compte ne correspond à cet email.";
            header("Location: ../views/forget-password.php");
            exit();
        }

        $token = bin2hex(random_bytes(16));
        $tokenEnregistre = $etudiant->enregistrerToken($user["id"], $token);

        if (!$tokenEnregistre) {
            $_SESSION["error"] = "Impossible de générer le lien pour le moment.";
            header("Location: ../views/forget-password.php");
            exit();
        }

        $resetLink = "http://localhost/gestions_etudiants/app/views/reset-password.php?token=" . $token;
        $message = "<p>Bonjour " . htmlspecialchars($user["nom"]) . ",</p>"
            . "<p>Vous avez demandé à réinitialiser votre mot de passe.</p>"
            . "<p>Cliquez sur le lien ci-dessous pour créer un nouveau mot de passe :</p>"
            . "<p><a href=\"" . $resetLink . "\">Créer mon nouveau mot de passe</a></p>";

        $mailResult = envoyerEmail($email, $user["nom"], 'Réinitialisation de votre mot de passe', $message);

        if ($mailResult === true) {
            $_SESSION["success"] = "Un lien de réinitialisation a été envoyé à votre email.";
        } else {
            $_SESSION["error"] = "Le lien n’a pas pu être envoyé. Réessayez plus tard.";
        }

        header("Location: ../views/forget-password.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new ForgotPasswordController();
    $controller->envoyerLien();
}