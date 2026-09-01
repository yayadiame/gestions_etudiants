<?php

require_once __DIR__ . '/../models/dashboard_admin.php';

class DashboardController{
    private DashboardAdmin $model;

    public function __construct()
    {
        $this->model = new DashboardAdmin();
    }

    public function index(): void{
        $totalEtudiants = $this->model->totalEtudiants();
        $totalProfesseurs = $this->model->totalProfesseurs();
        $totalClasses = $this->model->totalClasses();

        $derniersEtudiants = $this->model->derniersEtudiants();
        $derniersProfesseurs = $this->model->derniersProfesseurs();

        require_once __DIR__ . '/../views/admin/dashboard_admin.php';
    }
}