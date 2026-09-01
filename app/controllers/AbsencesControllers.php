<?php
require_once __DIR__ . "/../models/mes_absences.php";
session_start();

class AbsencesControllers {
    public function ajouterAbsence() {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $motif = isset($_POST['motif']) ? trim($_POST['motif']) : '';
            $id_etudiant = isset($_POST['id_etudiant']) ? intval($_POST['id_etudiant']) : 0;
            $id_matiere = isset($_POST['id_matiere']) ? intval($_POST['id_matiere']) : 0;
            
            // Validation basique
            if(empty($motif) || empty($id_etudiant) || empty($id_matiere)){
                $_SESSION['erreur'] = "Veuillez remplir tous les champs !";
                header('location:../views/etudiant/mes_absences.php');
                exit();
            }

            // Création de l'objet Absence avec validations
            $absencesModels = new Absence($id_etudiant, $id_matiere, $motif);

            $result = $absencesModels->ajouterAbsence();
            if($result){
                $_SESSION['success'] = "Absence ajoutée avec succès.";
            } else {
                $_SESSION['erreur'] = "Erreur lors de l'ajout de l'absence.";
            }

            header('location:../views/etudiant/mes_absences.php');
            exit();
        }
    }
    public function accepter(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $absence = new Absence("", "", "");

            if ($absence->accepter($id)) {
                $_SESSION['success'] = "Absence acceptée avec succès.";
            } else {
                $_SESSION['erreur'] = "Erreur lors de l'acceptation.";
            }

            header("Location: ../views/prof/absences.php");
            exit();
        }
    }

    public function refuser(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $absence = new Absence("", "", "");

            if ($absence->refuser($id)) {
                $_SESSION['success'] = "Absence refusée avec succès.";
            } else {
                $_SESSION['erreur'] = "Erreur lors du refus.";
            }

            header("Location: ../views/prof/absences.php");
            exit();
        }
    }
}

// Déterminer l'action et l'exécuter
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $controller = new AbsencesControllers();
    
    $action = isset($_POST['action']) ? $_POST['action'] : 'ajouter';
    
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        $controller->ajouterAbsence();
    }
}
?>
