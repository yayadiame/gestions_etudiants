<?php
require_once __DIR__ . "/../../config/database.php";

class Matieres {
    private $nom;
    private $id_prof;
    private $coefficient;
    private $erreur;

    public function __construct($nom, $id_prof, $coefficient) {
        $this->nom = $nom;
        $this->id_prof = $id_prof;
        $this->coefficient = $coefficient;
        $this->erreur = "";
    }

    public function afficherMatieres($limit = null, $offset = null){
        $db = new Database();
        $conn= $db->connexion();

        try {
            $sql = "SELECT
                matiere.*,
                users.nom AS nom_prof
               FROM matiere
               LEFT JOIN users ON matiere.id_prof = users.id
               ORDER BY matiere.nom ASC";

            if ($limit !== null && $offset !== null) {
                $sql .= " LIMIT :limit OFFSET :offset";
            }

            $stmt=$conn->prepare($sql);

            if ($limit !== null && $offset !== null) {
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? $result : [];
        } catch (PDOException $e) {
            $this->erreur = "Erreur lors du chargement des matières: " . $e->getMessage();
            return [];
        }
    }

    public function compterMatieres(){
        $db = new Database();
        $conn = $db->connexion();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM matiere");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function afficherMatieresProf($id_prof){
        $db = new Database();
        $conn = $db->connexion();

        $stmt = $conn->prepare("SELECT * FROM matiere WHERE id_prof = :id_prof ORDER BY nom ASC");
        $stmt->execute([':id_prof' => $id_prof]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getErreur(){
        return $this->erreur;
    }

    public function matieres(){
        $db = new Database();
        $conn= $db->connexion();

        try {
            $sql="INSERT INTO matiere (nom, id_prof, coefficient)
            VALUES(:nom, :id_prof, :coefficient)";
            $stmt=$conn->prepare($sql);

            return $stmt->execute([
                ":nom" =>$this->nom,
                ":id_prof" =>$this->id_prof,
                ":coefficient" =>$this->coefficient
            ]);
        } catch (PDOException $e) {
            $this->erreur = "Erreur lors de l'ajout de la matière: " . $e->getMessage();
            return false;
        }
    }
    public function supprimerMatiere($id) {
        $db = new Database();
        $conn= $db->connexion();

        $sql = "DELETE FROM matiere WHERE id=:id";
        $stmt=$conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}