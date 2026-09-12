<?php
require_once __DIR__ . "/../../config/database.php";

class DashboardEtudiant {
    private $db;
    public function __construct() {
        $conns = new database();
        $this->db = $conns->connexion();
    }
    public function NmbrMatieres($id_prof) {
        $sql="SELECT COUNT(*) FROM matiere";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();

    }
    public function NmbrAbsences($id_etudiant) {
        $sql="SELECT COUNT(*) FROM absences WHERE id_etudiant=:id_etudiant ";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([':id_etudiant' => $id_etudiant]);
        return $stmt->fetchColumn();
    }
     // ===== c l'iA qui la fais parce que je nai pas compris
    //  apres les explications jai fini a comprendre======
    
        public function prochainsCours($id_prof)
    {
            $sql = "SELECT emploi_du_temps.*, classe.nom AS nom_classe
                    FROM emploi_du_temps
                    INNER JOIN classe ON emploi_du_temps.id_classe = classe.id
                    WHERE emploi_du_temps.id_prof = :id_prof
                    ORDER BY emploi_du_temps.heure_debut ASC
                    LIMIT 5";

        $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_prof' => $id_prof]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}