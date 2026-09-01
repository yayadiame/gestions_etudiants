<?php

session_start();

require_once __DIR__ . "/../models/User.php";

class UserControllers{
    private $user;

    public function __construct(){
        $this->user = new User();
    }

    public function login(){
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if (empty($email) || empty($password)) {
            echo "Veuillez remplir tous les champs.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Adresse email invalide.";
            return;
        }

        $user = $this->user->lecteurUser($email);

        if (!$user) {
            echo "Email ou mot de passe incorrect.";
            return;
        }

        if (!password_verify($password, $user["password"])) {
            echo "Email ou mot de passe incorrect.";
            return;
        }

        $_SESSION["id"] = $user["id"];
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["role"] = $user["role"];

        if ($user["role"] == "admin") {
            header("Location: ../views/admin/dashboard_admin.php");
        } elseif ($user["role"] == "prof") {
            header("Location: ../views/prof/dashboard_prof.php");
        } else {
            header("Location: ../views/etudiant/dashboard_etudiant.php");
        }

        exit();
    }

    // public function updateProfile(){
        // $id = $_SESSION["id"];
// 
        // if (isset($_FILES["photo"]) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // $file = $_FILES['photo'];
            // $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            // $allowed = ['jpg','jpeg','png','gif','webp'];
            // if (!in_array($ext, $allowed)) {
                // $_SESSION['erreur'] = 'Format d\'image non supporté.';
                // header("Location: ../views/admin/profil.php");
                // exit();
            // }
// 
            // $uploadDir = __DIR__ . '/../../public/uploads/';
            // if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
// 
            // $targetName = 'user_' . $id . '.' . $ext;
            // $targetPath = $uploadDir . $targetName;
// 
            // if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // $relPath = 'public/uploads/' . $targetName;
                // $_SESSION['photo'] = $relPath;
                // Enregistrer en base
                // if (!$this->user->updatePhoto($id, $relPath)) {
                    // $_SESSION['erreur'] = 'Impossible d\'enregistrer la photo en base de données.';
                // }
            // } else {
                // $_SESSION['erreur'] = 'Impossible de déplacer le fichier uploadé.';
            // }
    //     }
 
    //     header("Location: ../views/admin/profil.php");
    //     exit();
    // }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $controller = new UserControllers();

    // if (isset($_POST["action"]) && $_POST["action"] == "update_profile") {
    //     $controller->updateProfile();
    // } else {
        $controller->login();
    // }
}