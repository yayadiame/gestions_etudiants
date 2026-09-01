<?php

require_once __DIR__ . "/../../config/database.php";

class Absence
{
    private $id_etudiant;
    private $id_matiere;
    private $motif;
    private $statut;
    private $db;
    private $erreur;

    public function __construct($id_etudiant, $id_matiere, $motif)
    {
        $database = new Database();
        $this->db = $database->connexion();

        $this->id_etudiant = $id_etudiant;
        $this->id_matiere = $id_matiere;
        $this->motif = $motif;
        $this->statut = "en_attente";
        $this->erreur = "";
    }

    public function afficherAbsences($id_etudiant = null)
    {
        $sql = "SELECT
                    absences.*,
                    users.nom AS nom_etudiant,
                    matiere.nom AS nom_matiere
                FROM absences
                JOIN users ON absences.id_etudiant = users.id
                JOIN matiere ON absences.id_matiere = matiere.id";
        $params = [];

        if ($id_etudiant !== null) {
            $sql .= " WHERE absences.id_etudiant = :id_etudiant";
            $params[':id_etudiant'] = $id_etudiant;
        }

        $sql .= " ORDER BY absences.date_absence DESC, absences.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function afficherAbsencesProf($id_prof){
        $sql = "SELECT
                    absences.*,
                    users.nom AS nom_etudiant,
                    matiere.nom AS nom_matiere
                FROM absences
                JOIN users ON absences.id_etudiant = users.id
                JOIN matiere ON absences.id_matiere = matiere.id
                WHERE matiere.id_prof = :id_prof
                ORDER BY absences.date_absence DESC, absences.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_prof' => $id_prof]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function matiereExiste()
    {
        $sql = "SELECT id FROM matiere WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $this->id_matiere
        ]);

        return $stmt->fetch() !== false;
    }

    public function etudiantExiste()
    {
        $sql = "SELECT id FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $this->id_etudiant
        ]);

        return $stmt->fetch() !== false;
    }

    public function getErreur()
    {
        return $this->erreur;
    }

    public function ajouterAbsence()
    {
        if (
            empty($this->id_etudiant) ||
            empty($this->id_matiere) ||
            empty($this->motif)
        ) {
            $this->erreur = "Tous les champs sont obligatoires";
            return false;
        }

        if (!$this->matiereExiste()) {
            $this->erreur = "La matière sélectionnée n'existe pas";
            return false;
        }

        if (!$this->etudiantExiste()) {
            $this->erreur = "L'étudiant n'existe pas";
            return false;
        }

        $sql = "INSERT INTO absences
                (id_etudiant, id_matiere, motif, statut, date_absence)
                VALUES
                (:id_etudiant, :id_matiere, :motif, :statut, :date_absence)";

        try {
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':id_etudiant' => $this->id_etudiant,
                ':id_matiere' => $this->id_matiere,
                ':motif' => $this->motif,
                ':statut' => $this->statut,
                ':date_absence' => date('Y-m-d')
            ]);

        } catch (PDOException $e) {
            $this->erreur = "Erreur lors de l'ajout de l'absence : " . $e->getMessage();
            return false;
        }
    }
    //chat 
        public function accepter($id){
    // public function accepter($id){
        $sql = "UPDATE absences  SET statut = 'acceptee'  WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function refuser($id){
        $sql = "UPDATE absences  SET statut = 'refusee' 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
// }