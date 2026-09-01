<?php
require_once __DIR__ . "/../models/classe.php";
// require_once __DIR__ . "/../../config/mail.php";
session_start();

class ClasseControllers {
    public function ajouterClasse() {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nom = $_POST['nom'];
            $niveau = $_POST['niveau'];
            $filier = $_POST['filier'];
           
            if(empty($nom)|| empty($niveau)|| empty($filier)){
                $_SESSION['erreur']="veuillez remplie tous les champs";
                header('location:../views/admin/classe.php');
                exit();
            }
            $classeModels = new Classe($nom, $niveau, $filier);
            
            $classeModels->ajouterClasse();

             header('location:../views/admin/classe.php');
                exit();

            
        }
    }
    

    // SUPPRIMER UNE CLASSE
    public function supprimerClasse() {
        $id = $_GET['id']; 
        $classeModel = new Classe(null, null, null);

        $classeModel->supprimerClasse($id);

        // $_SESSION['success'] = "Classe supprimée avec succès";

        header('Location: ../views/admin/classe.php');
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlllers1 = new ClasseControllers();
    $controlllers1->ajouterClasse();
} elseif (
    $_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'supprimer') {
    $controlllers1 = new ClasseControllers();
    $controlllers1->supprimerClasse();
}