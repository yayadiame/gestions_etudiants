<?php
require_once __DIR__ . '/../../config/database.php';

class Etudiant {
    private $nom;
    private $email;

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function ajouterEtudiant() {
        $db = new Database();
        $conn = $db->connexion();
        // Vérifier email
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $this->email]);

        if ($stmt->rowCount() > 0) {
            return "Cet email existe déjà";
        }
        // Ajouter étudiant
        $sql = "INSERT INTO users(nom, email, role)
                VALUES(:nom, :email, 'etudiant')";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email
        ]);

        return $conn->lastInsertId();
    }

    public function afficherEtudiants() {
        $db = new Database();
        $conn = $db->connexion();

        if ($conn === null) {
            return [];
        }

        $sql = "SELECT * FROM users WHERE role = 'etudiant' ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}
