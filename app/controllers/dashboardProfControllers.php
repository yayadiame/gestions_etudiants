<?php
require_once __DIR__ . "/../../models/dashboard_prof.php";

class DashboardProfControllers {
    private $models;

    public function __construct() {
        $this->models = new DashboardProf();
    }

    public function index(): void {
        $this->totalEtudiant = $this->models->nmbrEtudiant($id_prof);
        $this->totalClasses = $this->models->NmbrClasses($id_prof);
        $this->totalMatieres = $this->models->NmbrMatieres($id_prof);
        $this->totalNotes = $this->models->NmbrNotes($id_prof);

        require_once __DIR__ . "/../views/prof/dashboard_prof.php";
    }
}