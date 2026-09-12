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
        $id_classe = $_POST["id_classe"] ?? "";

        if (empty($nom) || empty($email) || empty($id_classe)) {
            $_SESSION["etudiant_error"] = "Veuillez remplir tous les champs.";
            header("Location: ../views/admin/etudiant.php");
            exit();
        }

        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     $_SESSION["etudiant_error"] = "Adresse email invalide.";
        //     header("Location: ../views/admin/etudiant.php");
        //     exit();
        // }

        // Créer l'étudiant
        $etudiant = new Etudiant($nom, $email, $id_classe);

        // Ajouter dans la base et récupérer son ID
        $user_id = $etudiant->ajouterEtudiant();

        // Vérifier si l'ajout a échoué
        // if (!is_numeric($user_id)) {
        //     $_SESSION["etudiant_error"] = $id_user;
        //     header("Location: ../views/admin/etudiant.php");
        //     exit();
        // }
 
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

        header("Location: ../views/admin/etudiant.php");
        exit();
    }

    public function supprimerEtudiants($email) {
        
      $etudiant = new Etudiant(null, null);

       // Ajouter dans la base et récupérer son ID
      $user_id = $etudiant->supprimerEtudiant($email);
            
        header("Location: ../views/admin/etudiant.php");
        exit();
    }

    //ce que je nai pas encorer compris 
    // 📤 EXPORT
    public function exporter()
    {
        $etudiant = new Etudiant(null, null);

        $etudiants = $etudiant->exporterEtudiants();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=etudiants.csv');

        $fichier = fopen('php://output', 'w');

        fputcsv($fichier, ['Nom', 'Email', 'Classe']);

        foreach ($etudiants as $etudiant) {
            fputcsv($fichier, [
                $etudiant['nom'],
                $etudiant['email'],
                $etudiant['nom_classe']
            ]);
        }
        fclose($fichier);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new EtudiantControllers();
    $controller->ajouter();
}elseif ($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['email']) && ($_GET['action']==='supprimer')) {
    $controller = new EtudiantControllers();
    $controller->supprimerEtudiants($_GET['email']);
} 
elseif ( $_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'exporter') {
    $controller = new EtudiantControllers();
    $controller->exporter();
}