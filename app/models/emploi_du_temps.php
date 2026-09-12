<?php
require_once __DIR__ . '/../../config/database.php';

class Planning {
    private $jour;
    private $heure_debut;
    private $heure_fin;
    private $id_classe;
    private $id_prof;
    private $id_matiere;

    public function __construct($jour, $heure_debut, $heure_fin, $id_classe, $id_prof, $id_matiere) {
        $this->jour = $jour;
        $this->heure_debut = $heure_debut;
        $this->heure_fin = $heure_fin;
        $this->id_classe = $id_classe;
        $this->id_prof = $id_prof;
        $this->id_matiere = $id_matiere;
    }

    public function afficherPlanning($id_classe = null, $limit = null, $offset = null) {
        $db = new Database();
        $conn = $db->connexion();
        
        $sql = "SELECT e.*, c.nom AS classe, m.nom AS matiere, u.nom AS professeur
                FROM emploi_du_temps e
                LEFT JOIN classe c ON e.id_classe = c.id
                LEFT JOIN matiere m ON e.id_matiere = m.id
                LEFT JOIN users u ON e.id_prof = u.id";

        if ($id_classe !== null) {
            $sql .= " WHERE e.id_classe = :id_classe";
        }

        $sql .= " ORDER BY e.id DESC";

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $conn->prepare($sql);

        if ($id_classe !== null) {
            $stmt->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);
        }

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function compterPlanning($id_classe = null) {
        $db = new Database();
        $conn = $db->connexion();

        $sql = "SELECT COUNT(*) FROM emploi_du_temps";
        if ($id_classe !== null) {
            $sql .= " WHERE id_classe = :id_classe";
        }

        $stmt = $conn->prepare($sql);
        if ($id_classe !== null) {
            $stmt->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);
        }
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function afficherPlanningProf($id_prof) {
        $db = new Database();
        $conn = $db->connexion();

        $sql = "SELECT e.*, c.nom AS classe, m.nom AS matiere, u.nom AS professeur
                FROM emploi_du_temps e
                LEFT JOIN classe c ON e.id_classe = c.id
                LEFT JOIN matiere m ON e.id_matiere = m.id
                LEFT JOIN users u ON e.id_prof = u.id
                WHERE e.id_prof = :id_prof
                ORDER BY e.id DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':id_prof' => $id_prof]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function afficherPlanningEtudiant($id_etudiant, $limit = null, $offset = null) {
        $db = new Database();
        $conn = $db->connexion();

        $sql = "SELECT e.*, c.nom AS classe, m.nom AS matiere, u.nom AS professeur
                FROM emploi_du_temps e
                JOIN users etudiant ON etudiant.id = :id_etudiant
                LEFT JOIN classe c ON e.id_classe = c.id
                LEFT JOIN matiere m ON e.id_matiere = m.id
                LEFT JOIN users u ON e.id_prof = u.id
                WHERE e.id_classe = etudiant.id_classe
                ORDER BY e.id DESC";

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_etudiant', $id_etudiant, PDO::PARAM_INT);

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function compterPlanningEtudiant($id_etudiant) {
        $db = new Database();
        $conn = $db->connexion();

        $sql = "SELECT COUNT(*)
                FROM emploi_du_temps e
                JOIN users etudiant ON etudiant.id = :id_etudiant
                WHERE e.id_classe = etudiant.id_classe";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id_etudiant' => $id_etudiant]);

        return (int) $stmt->fetchColumn();
    }

    public function ajouterPlanning() {
        $db = new Database();
        $conn = $db->connexion();

        $sql = "INSERT INTO emploi_du_temps (jour, heure_debut, heure_fin, id_classe, id_prof, id_matiere)
                VALUES (:jour, :heure_debut, :heure_fin, :id_classe, :id_prof, :id_matiere)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":jour" => $this->jour,
            ":heure_debut" => $this->heure_debut,
            ":heure_fin" => $this->heure_fin,
            ":id_classe" => $this->id_classe,
            ":id_prof" => $this->id_prof,
            ":id_matiere" => $this->id_matiere
        ]);

        return $conn->lastInsertId();
    }
    public function supprimerPlanning($id) {
         $db = new Database();
        $conn = $db->connexion();

        $sql="DELETE FROM emploi_du_temps WHERE id= :id";
        $stmt= $conn->prepare($sql);
       return $stmt->execute([
        ':id' =>$id
        ]);
    }
}