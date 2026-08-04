<?php

require_once __DIR__ . "/../models/User.php";
// session_start();
class UserControllers{
    private $user;

    public function __construct(){
        $this->user = new User();
    }
    public function login(){
        // Récupérer les données du formulaire
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        // Vérifier si les champs sont vides
        if (empty($email) || empty($password)) {
            echo "Veuillez remplir tous les champs.";
            return;
        }
        // Vérifier le format de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Adresse email invalide.";
            return;
        }
        // Chercher l'utilisateur
        $user = $this->user->lecteurUser($email);
        // Vérifier si l'utilisateur existe
        if (!$user) {
            echo "Email ou mot de passe incorrect.";
            return;
        }
        // Vérifier le mot de passe
        if (!password_verify($password, $user["password"])) {
            echo "Email ou mot de passe incorrect.";
            return;
        }
        // Créer la session
        $_SESSION["id"] = $user["id"];
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["role"] = $user["role"];
        // Redirection selon le rôle
        if ($user["role"] == "admin") {
            header("Location: ../views/admin/dashboard_admin.php");
            exit();
            
        } elseif ($user["role"] == "prof") {
            header("Location: ../views/prof/dashboard_prof.php");
            exit();

        } else {
            header("Location: ../views/etudiant/dashboard_etudiant.php");
            exit();
        }
    }
}
// Lancer la connexion lorsque le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $controller = new UserControllers();
    $controller->login();

}