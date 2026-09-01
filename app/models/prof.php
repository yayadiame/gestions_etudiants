<?php
require_once __DIR__ . "/../../config/database.php";

class Prof {
    private $nom;
    private $email;

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function ajouterProf() {
        $db = new Database();
        $conn = $db->connexion();
        if ($conn === null) {
            return 'Erreur de connexion à la base de données.';
        }

        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':email' => $this->email
        ]);

        if ($stmt->rowCount() > 0) {
            return 'Désolé, cet email existe déjà.';
        }

        $sql = "INSERT INTO users (nom, email, role) VALUES(:nom, :email, 'prof')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email
        ]);

        return $conn->lastInsertId();
    }

    public function afficherProf($limit = null, $offset = null) {
        $db = new Database();
        $conn = $db->connexion();
        if ($conn === null) {
            return [];
        }

        $sql = "SELECT * FROM users WHERE role = 'prof' ORDER BY id DESC";

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $conn->prepare($sql);

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function compterProf() {
        $db = new Database();
        $conn = $db->connexion();
        if ($conn === null) {
            return 0;
        }

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = 'prof'");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function enregisterToken($id_users, $token) {
        $db = new Database();
        $conn = $db->connexion();
        if ($conn === null) {
            return false;
        }

        $sql = 'INSERT INTO password_resets (id_users, token) VALUES(:id_users, :token)';
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':id_users' => $id_users,
            ':token' => $token
        ]);
    }

   public function supprimerProf($email) {
            $db = new Database();
            $conn = $db->connexion();

            if ($conn === null) {
                return false;
            }

            try {
                $conn->beginTransaction();
                // 1. Récupérer l'id du professeur
                $sql = "SELECT id FROM users WHERE email = :email AND role = 'prof'";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':email' => $email
                ]);

                $prof = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$prof) {
                    $conn->rollBack();
                    return false;
                }

                $id_prof = $prof['id'];
                $sql = "DELETE FROM emploi_du_temps
                        WHERE id_prof = :id_prof  OR id_matiere IN (
                               SELECT id FROM matiere WHERE id_prof = :id_prof_matieres
                           )";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':id_prof' => $id_prof,
                    ':id_prof_matieres' => $id_prof
                ]);
                $sql = "DELETE FROM notes
                        WHERE id_matiere IN (
                            SELECT id FROM matiere WHERE id_prof = :id_prof)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':id_prof' => $id_prof
                ]);

                $sql = "DELETE FROM password_resets WHERE id_users = :id_prof";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':id_prof' => $id_prof
                ]);

                $sql = "DELETE FROM absences
                        WHERE id_matiere IN (SELECT id FROM matiere WHERE id_prof = :id_prof)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':id_prof' => $id_prof
                ]);

                $sql = "DELETE FROM matiere WHERE id_prof = :id_prof";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':id_prof' => $id_prof
                ]);

                $sql = "DELETE FROM users WHERE id = :id_prof";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':id_prof' => $id_prof
                ]);

                $conn->commit();

                return true;

            } catch (PDOException $e) {

                if ($conn->inTransaction()) {
                    $conn->rollBack();
                }
                return false;
            }
        }
}
