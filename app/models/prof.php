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

    public function afficherProf() {
        $db = new Database();
        $conn = $db->connexion();
        if ($conn === null) {
            return [];
        }

        $sql = "SELECT * FROM users WHERE role = 'prof' ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}
