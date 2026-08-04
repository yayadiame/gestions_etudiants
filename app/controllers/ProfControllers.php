<?php
require_once __DIR__ . "/../models/etudiant.php";
require_once __DIR__ . "/../../config/mail.php";
session_start();

class ProfControllers {
    public function ajouter() {
       if($_SERVER['REQUEST_METHOD'] == "POST"){
        header('location: ../views/admin/prof.php');
        exit();
       } 
       $nom = $_POST['nom'];
       $email = $_POST['email'];

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
            $_SESSION["etudiant_error"] = $id_user;
            header("Location: ../views/admin/etudiant.php");
            exit();
        }

        $token = bin2hex(random_bytes(16));
        $profs->enregisterToken($id_user,$token);

        $messages = "http://localhost/gestions_etudiants/app/views/reset-password.php?token=" . $token;
        $lienMessages = "<p>Bonjour" . ($nom) .", </p>".
        "<p>Votre compte a été activé avec succées. </p>". 
        "<p>Merci de clicker sur ce lien pour changer votre mot de passe </p>". 
        "<p><a href=\"" . $messages . "\">" . $messages . "</a></p>";
        $resultMeassages = envoyerMail($nom,$email , "BIENVENUE VEUILLEZ CHANGER VOTRE MOT DE PASSE");

        header('location:../views/admin/prof.php');
        exit();
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $controller = new ProfControllers();
    $controller->ajouter();
}
// cissealy360@gmail.com