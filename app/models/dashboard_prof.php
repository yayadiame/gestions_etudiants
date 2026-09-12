<?php
require_once __DIR__ . "/../../config/database.php";

class DashboardProf {
    private $db;

    public function __construct() {
        $conn = new Database();
        $this->db = $conn->connexion();
    }

    public function nmbrEtudiant($id_prof) {
         $sql = "SELECT COUNT(*)
            FROM (
                SELECT DISTINCT n.id_etudiant
                FROM notes n
                INNER JOIN matiere m ON m.id = n.id_matiere
                WHERE m.id_prof = :id_prof_notes

                UNION

                SELECT DISTINCT a.id_etudiant
                FROM absences a
                INNER JOIN matiere m ON m.id = a.id_matiere
                WHERE m.id_prof = :id_prof_absences
            ) AS etudiants";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_prof_notes' => $id_prof,
            ':id_prof_absences' => $id_prof
        ]);
        return $stmt->fetchColumn(); 
       }

    public function NmbrClasses($id_prof) {
        $sql = "SELECT COUNT(DISTINCT id_classe)
                FROM emploi_du_temps  WHERE id_prof = :id_prof";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_prof' => $id_prof]);
        return $stmt->fetchColumn();
       }

    public function NmbrMatieres($id_prof) {
        $sql = "SELECT COUNT(*)
                FROM matiere WHERE id_prof = :id_prof";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_prof' => $id_prof]);
        return $stmt->fetchColumn();
       }
    public function NmbrNotes($id_prof) {
        $sql = "SELECT COUNT(*)
            FROM notes n
            INNER JOIN matiere m ON m.id = n.id_matiere
            WHERE m.id_prof = :id_prof";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_prof' => $id_prof]);
        return $stmt->fetchColumn();
       }

    public function mesClasses($id_prof) {
        $sql = "SELECT
                    c.id,
                    c.nom,
                    COUNT(DISTINCT activite.id_etudiant) AS total_eleves
                FROM emploi_du_temps e
                INNER JOIN classe c ON c.id = e.id_classe
                LEFT JOIN (
                    SELECT id_etudiant, id_matiere FROM notes
                    UNION
                    SELECT id_etudiant, id_matiere FROM absences
                ) AS activite ON activite.id_matiere = e.id_matiere
                WHERE e.id_prof = :id_prof
                GROUP BY c.id, c.nom
                ORDER BY c.nom ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_prof' => $id_prof]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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