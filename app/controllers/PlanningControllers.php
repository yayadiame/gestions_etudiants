<?php
require_once __DIR__ . "/../models/emploi_du_temps.php";
session_start();

class PlanningControllers {
    public function ajouterPlanning() {
        $jour = $_POST['jour'];
        $heureDebut = $_POST['heure_debut'];
        $heureFin = $_POST['heure_fin'];
        $idClasse = $_POST['id_classe'];
        $idProf = $_POST['id_prof'];
        $idMatiere = $_POST['id_matiere'];

        if (empty($jour) || empty($heureDebut) || empty($heureFin) || empty($idClasse) || empty($idProf) || empty($idMatiere)) {
            $_SESSION['erreur'] = "Veuillez remplir tous les champs !";
            header('Location: ../views/admin/emploi_du_temps.php');
            exit();
        }

        $planning = new Planning($jour, $heureDebut, $heureFin, $idClasse, $idProf, $idMatiere);
        $planning->ajouterPlanning();

        header('Location: ../views/admin/emploi_du_temps.php');
        exit();
    }
    
    public function supprimerPlanning() {
        $id = $_GET['id'];

        $planning = new Planning(null, null, null, null, null, null);
        $planning->supprimerPlanning($id);

        header('Location: ../views/admin/emploi_du_temps.php');
        exit();
    }

}
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $controllersA = new PlanningControllers();
    $controllersA->ajouterPlanning();
}elseif($_SERVER['REQUEST_METHOD']=== 'GET'  && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'supprimer'){
     $controllersA = new PlanningControllers();
    $controllersA->supprimerPlanning();
}