<?php
require_once __DIR__ . "/../../config/database.php";

class Notes {
    private $type_note;
    private $note;
    private $id_etudiant;
    private $id_matiere;

    public function __construct($type_note, $note, $id_etudiant, $id_matiere) {
        $this->type_note = $type_note;
        $this->note = $note;
        $this->id_etudiant = $id_etudiant;
        $this->id_matiere = $id_matiere;
    }
         public function afficherNotes($limit = null, $offset = null) {
        $db = new Database();
        $conn = $db->connexion();

        $sql = "SELECT 
                notes.*, 
                users.nom AS nom_etudiant,
                users.email AS email_etudiant,
                matiere.nom AS nom_matiere
                FROM notes
                JOIN users ON notes.id_etudiant = users.id
                JOIN matiere ON notes.id_matiere = matiere.id
                ORDER BY notes.id DESC";

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt=$conn->prepare($sql);

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

      public function afficherNotesProf($id_prof) {
          $db = new Database();
          $conn = $db->connexion();

          $sql = "SELECT notes.*, users.nom AS nom_etudiant,
                              users.email AS email_etudiant,
                              matiere.nom AS nom_matiere
                     FROM notes
                     JOIN users ON notes.id_etudiant = users.id
                     JOIN matiere ON notes.id_matiere = matiere.id
                     WHERE matiere.id_prof = :id_prof
                     ORDER BY notes.id DESC";

          $stmt = $conn->prepare($sql);
          $stmt->execute([':id_prof' => $id_prof]);

          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function afficherNotesEtudiant($id_etudiant) {
          $db = new Database();
          $conn = $db->connexion();

          $sql = "SELECT notes.*, matiere.nom AS nom_matiere
                  FROM notes
                  JOIN matiere ON notes.id_matiere = matiere.id
                  WHERE notes.id_etudiant = :id_etudiant
                  ORDER BY notes.id DESC";

          $stmt = $conn->prepare($sql);
          $stmt->execute([':id_etudiant' => $id_etudiant]);

          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

     public function compterNotes() {
        $db = new Database();
        $conn = $db->connexion();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM notes");
        $stmt->execute();

        return $stmt->fetchColumn();
     }
     public function notes() {
         $db = new Database();
        $conn = $db->connexion();

        $sql="INSERT INTO notes(type_note, note, id_etudiant, id_matiere)
        VALUES(:type_note, :note, :id_etudiant, :id_matiere)";
        $stmt=$conn->prepare($sql);
        $stmt->execute([
            ":type_note" => $this->type_note,
            ":note" => $this->note,
            ":id_etudiant" => $this->id_etudiant,
            ":id_matiere" => $this->id_matiere
        ]);
     }
     public function supprimerNote($id) {
        $db = new Database();
        $conn = $db->connexion();

        $sql="DELETE FROM notes WHERE id=:id";
        $stmt=$conn->prepare($sql);
        return $stmt->execute([
            ':id' =>$id
        ]);
     }
}