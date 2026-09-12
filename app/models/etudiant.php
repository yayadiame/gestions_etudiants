<?php
require_once __DIR__ . '/../../config/database.php';

class Etudiant {
    private $nom;
    private $email;
    private $id_classe;

    public function __construct($nom, $email, $id_classe = null) {
        $this->nom = $nom;
        $this->email = $email;
        $this->id_classe = $id_classe;
    }

    public function ajouterEtudiant() {
        $db = new Database();
        $conn = $db->connexion();
        // Vérifier email
        //  $sql = "SELECT * FROM users WHERE role = 'etudiant' ORDER BY id DESC";
       
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $this->email]);

        if ($stmt->rowCount() > 0) {
            return "Cet email existe déjà";
        }
        // Ajouter étudiant
        $sql = "INSERT INTO users(nom, email, role, id_classe)
                VALUES(:nom, :email, 'etudiant', :id_classe)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email,
            ':id_classe' => $this->id_classe
        ]);

        return $conn->lastInsertId();
    }

    public function afficherEtudiants($limit = null, $offset = null) {
        $db = new Database();
        $conn = $db->connexion();

        if ($conn === null) {
            return [];
        }

        $sql = "SELECT u.*, c.nom AS nom_classe
                FROM users u
                LEFT JOIN classe c ON u.id_classe = c.id
                WHERE u.role = 'etudiant'
                ORDER BY u.id DESC";

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

    public function compterEtudiants() {
        $db = new Database();
        $conn = $db->connexion();

        if ($conn === null) {
            return 0;
        }

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = 'etudiant'");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function enregistrerToken($id_users, $token) {

        $db = new Database();
        $conn = $db->connexion();

        $sql = "INSERT INTO password_resets(id_users, token, expires_at)
                VALUES(:id_users, :token, DATE_ADD(NOW(), INTERVAL 1 HOUR))";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':id_users' => $id_users,
            ':token' => $token
        ]);

    }

    //pour le password oublie expliquer par chatGPT
    public function trouverParEmail($email){
        $db = new Database();
        $conn = $db->connexion();

        $sql = "SELECT id, nom, email
                FROM users  WHERE email = :email";
        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function definirMotDePasse($token, $password) {
        $db = new Database();
        $conn = $db->connexion();

        // Trouver l'utilisateur avec le token
        $sql = "SELECT id_users FROM password_resets  WHERE token = :token  AND expires_at > NOW()";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':token' => $token]);

        $reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reset) {
            return "Token invalide";
        }

        // Chiffrer le mot de passe
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Modifier le mot de passe
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':password' => $password,
            ':id' => $reset['id_users']
        ]);

        // Supprimer le token
        $sql = "DELETE FROM password_resets WHERE token = :token";
        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':token' => $token
        ]);
        return true;
    }

        public function supprimerEtudiant($email){
        $db = new Database();
        $conn = $db->connexion();

        // Récupérer l'id de l'étudiant
        $sql = "SELECT id FROM users  WHERE email = :email  AND role = 'etudiant'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);

        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$etudiant) {
            return false;
        }

        $id = $etudiant['id'];

        // Supprimer les notes
        $sql = "DELETE FROM notes WHERE id_etudiant = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        // Supprimer l'étudiant
        $sql = "DELETE FROM users   WHERE id = :id   AND role = 'etudiant'";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    // NOUVELLE FONCTION
    public function exporterEtudiants() {
        $db = new Database();
        $conn = $db->connexion();

        $sql = "SELECT u.nom, u.email, c.nom AS nom_classe
                FROM users u
                LEFT JOIN classe c ON u.id_classe = c.id
                WHERE u.role = 'etudiant'
                ORDER BY u.nom ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function supprimerEtudiant($email) {
    //     $db = new Database();
    //     $conn = $db->connexion();

    //     $sql = "DELETE FROM users WHERE email=:email AND role = 'etudiant'";
    //     $stmt=$conn->prepare($sql);
    //     return $stmt->execute([
    //         ':email' => $email
    //     ]);
    // }
}
