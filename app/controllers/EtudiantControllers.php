<?php
require_once __DIR__ . "/../models/etudiant.php";
require_once __DIR__ . "/../../config/mail.php";
session_start();

class EtudiantControllers {
    public function ajouter() {

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ../views/admin/etudiant.php");
            exit();
        }

        $nom = trim($_POST["nom"] ?? "");
        $email = trim($_POST["email"] ?? "");

        if (empty($nom) || empty($email)) {
            $_SESSION["etudiant_error"] = "Veuillez remplir tous les champs.";
            header("Location: ../views/admin/etudiant.php");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["etudiant_error"] = "Adresse email invalide.";
            header("Location: ../views/admin/etudiant.php");
            exit();
        }

        // Créer l'étudiant
        $etudiant = new Etudiant($nom, $email);

        // Ajouter dans la base et récupérer son ID
        $user_id = $etudiant->ajouterEtudiant();

        // Vérifier si l'ajout a échoué
        if (!is_numeric($user_id)) {
            $_SESSION["etudiant_error"] = $id_user;
            header("Location: ../views/admin/etudiant.php");
            exit();
        }
 
        // Générer le token
        $token = bin2hex(random_bytes(16));
        $etudiant->enregistrerToken($user_id, $token);

        $resetLink = "http://localhost/gestions_etudiants/app/views/reset-password.php?token=" . $token;
        // Envoyer un email de bienvenue / de réinitialisation
        $mailMessage = "<p>Bonjour " . htmlspecialchars($nom) . ",</p>" .
            "<p>Votre compte étudiant a été créé avec succès.</p>" .
            "<p>Cliquez sur le lien suivant pour définir votre mot de passe :</p>" .
            "<p><a href=\"" . $resetLink . "\">" . $resetLink . "</a></p>";

        $mailResult = envoyerEmail($email, $nom, 'Bienvenue sur Gestion Étudiants - Définir votre mot de passe', $mailMessage);

        // if ($mailResult !== true) {
        //     $_SESSION["etudiant_success"] = "Étudiant ajouté avec succès, mais l'email n'a pas pu être envoyé.";
        //     $_SESSION["etudiant_error"] = $mailResult;
        // } else {
        //     $_SESSION["etudiant_success"] = "Étudiant ajouté avec succès et un email contenant le lien de mot de passe a été envoyé.";
        // }

        header("Location: ../views/admin/etudiant.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new EtudiantControllers();
    $controller->ajouter();
}