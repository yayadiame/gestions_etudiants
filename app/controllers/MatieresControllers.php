<?php
require_once __DIR__ . "/../models/matieres.php";
session_start();

class MatieresControllers {
 
    public function ajouterMatieres() {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nom = $_POST['nom'];
            $id_prof = $_POST['id_prof'];
            $coefficient = $_POST['coefficient'];

            if(empty($nom) || empty($id_prof) || empty($coefficient)){
                $_SESSION['erreur']="veuillez remplir tous les champs ! ";
                header('location:../views/admin/matieres.php');
                exit();
            }
            $matieresModels = new Matieres($nom, $id_prof, $coefficient);

            $matieresModels->matieres();

             header('location:../views/admin/matieres.php');
                exit();
        }
    }
    public function supprimerMatiers() {
         $id = $_GET['id'];

        $matieresModels = new Matieres(null, null, null);

            $matieresModels->supprimerMatiere($id); 

            header('location:../views/admin/matieres.php');
                exit();
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $controllers = new MatieresControllers();
    $controllers->ajouterMatieres();
}elseif ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id']) && $_GET['action']==='supprimer'){
        $controllers = new MatieresControllers();
        $controllers->supprimerMatiers($_GET['id']);
}