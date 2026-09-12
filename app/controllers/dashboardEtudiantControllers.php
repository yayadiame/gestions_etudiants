<?php
require_once __DIR__ . "/../../models/dashboard_etudiant.php";

class DashboardController {
    private $Modals;
    public function __construct() {
        $Modals = new DashboardEtudiant();
    }
    public function index():void {
     $totalMatieres=$Modals->NmbrMatieres($id_prof);
     $totalAbsences=$Modals->NmbrAbsences($id_etudiant);

     $prochainCours=$Modals->prochainsCours($id_prof);
     
     require_once __DIR__ . '/../views/etudiant/dashboard_etudiant.php';
    }
}