<?php
require_once __DIR__ . "/../models/prof.php";
require_once __DIR__ . "/../../config/mail.php";
session_start();

class ProfControllers {
    public function ajouter() {
         if($_SERVER['REQUEST_METHOD'] !== "POST"){
          header('location: ../views/admin/prof.php');
          exit();
         }

         $nom = trim($_POST['nom'] ?? '');
         $email = trim($_POST['email'] ?? '');

       if(empty($nom)|| empty($email)){
        header('location:../views/admin/prof.php');
        exit();
       }

       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = "email ou password incorrect !";
        header('location:../views/admin/prof.php');
        exit();
       }

       $profs = new Prof($nom , $email);
       $user_id = $profs->ajouterProf();

       if (!is_numeric($user_id)) {
          $_SESSION["prof_error"] = $user_id;
          header("Location: ../views/admin/prof.php");
            exit();
        }

        $token = bin2hex(random_bytes(16));
       $profs->enregisterToken($user_id, $token);

        $messages = "http://localhost/gestions_etudiants/app/views/reset-password.php?token=" . $token;
        $lienMessages = "<p>Bonjour" . ($nom) .", </p>".
        "<p>Votre compte a été activé avec succées. </p>". 
        "<p>Merci de clicker sur ce lien pour changer votre mot de passe </p>". 
        "<p><a href=\"" . $messages . "\">" . $messages . "</a></p>";
        $resultMeassages = envoyerEmail(
            $email,
            $nom,
            "BIENVENUE VEUILLEZ CHANGER VOTRE MOT DE PASSE",
            $lienMessages
        );

        header('location:../views/admin/prof.php');
        exit();
    }

    public function SupprimerProfs($email) {

       $profs = new Prof(null , null);
         $profs->supprimerProf($email);

         header('Location: ../views/admin/prof.php');
         exit();
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $controller = new ProfControllers();
    $controller->ajouter();
}elseif ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['email'] ) && $_GET['action']==='supprimer'){
    $controller = new ProfControllers();
    $controller->SupprimerProfs($_GET['email']);
}
// cissealy360@gmail.com