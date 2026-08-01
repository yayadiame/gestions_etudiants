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

        // Vérifier si l'email existe déjà
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $this->email]);

        if ($stmt->rowCount() > 0) {
            return "désolé, ce email existe deja";
        }

        $sql = "INSERT INTO users (nom, email, role) VALUES (:nom, :email, :role)";
        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email,
            ':role' => 'etudiant'
        ]);

        return $conn->lastInsertId();
    }
        public function enregistrerToken($id_users, $token) {

        $db = new Database();
        $conn = $db->connexion();

        $expiration = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $sql = "INSERT INTO password_resets (id_users, token, expires_at)
                VALUES (:id_users, :token, :expires_at)";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':id_users' => $id_users,
            ':token' => $token,
            ':expires_at' => $expiration
        ]);
    }
}
    
    // public function ajouterEtudiant() {
    //     $db = new Database();
    //     $conn = $db->connexion();

    //     // Vérifier si l'email existe déjà
    //     $sql = "SELECT * FROM users WHERE email = :email";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute([':email' => $this->email]);

    //     if ($stmt->rowCount() > 0) {
    //         return "désolé, ce email existe deja";
    //     }
    //     // return "ok";
    // }