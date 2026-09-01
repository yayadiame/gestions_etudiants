<?php
require_once __DIR__ . "/../../config/database.php";

class DashboardAdmin {
    
    private $db;

    public function __construct(){
        //  $db = new Database();
        // $conn = $db->connexion();
       $conn= new Database();
       $this->db = $conn->connexion();
    }

    // Nombre total d'étudiants
    public function totalEtudiants(){
        $sql = "SELECT COUNT(*) FROM users WHERE role = 'etudiant'";
        return $this->db->query($sql)->fetchColumn();
    }

    // Nombre total de professeurs
    public function totalProfesseurs(){
        $sql = "SELECT COUNT(*) FROM users WHERE role = 'prof'";
        return $this->db->query($sql)->fetchColumn();  //fetchColumn sert a rendre a nombre 
    }

    // Nombre total de classes
    public function totalClasses(){
        $sql = "SELECT COUNT(*) FROM classe";
        return $this->db->query($sql)->fetchColumn();

        // 2. Exécuter la requête
        //$resultat = $this->db->query($sql);
        // 3. Récupérer le résultat
        //$nombre = $resultat->fetchColumn();
        // 4. Retourner le nombre
        // return $nombre;
    }

    // Derniers étudiants
    public function derniersEtudiants(){
        $sql = "SELECT id, nom, email
                FROM users
                WHERE role = 'etudiant'
                ORDER BY id DESC
                LIMIT 5";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // Derniers professeurs
    public function derniersProfesseurs(){
        $sql = "SELECT id, nom, email FROM users WHERE role = 'prof'
                ORDER BY id DESC LIMIT 5";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}