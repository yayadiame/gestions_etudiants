<?php

require_once __DIR__ . "/../../config/database.php";

class Profil{
    private $connector;

    public function __construct(){
        $db = new Database();
        $this->connector = $db->connexion();
    }

    // Modifier le nom et l'email
    public function modifierProfil($id, $nom, $email) {
        $sql = "UPDATE users SET nom = ?, email = ? WHERE id = ?";

        $stmt = $this->connector->prepare($sql);

        return $stmt->execute([
            $nom,
            $email,
            $id
        ]);
    }

    // Modifier le mot de passe
    public function modifierPassword($id, $password){
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        $stmt = $this->connector->prepare($sql);

        return $stmt->execute([
            $password,
            $id
        ]);
    }

    // Récupérer les informations d'un utilisateur par id
    public function afficherProfil($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connector->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}