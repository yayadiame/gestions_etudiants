<?php
require_once __DIR__ . "/../../config/database.php";

class Classe {
    private $nom;
    private $niveau;
    private $filier;
   public function __construct($nom, $niveau, $filier) {
    $this->nom = $nom;
    $this->niveau = $niveau;
    $this->filier = $filier;
   }
   //pour la pajination jai modifier le afficheClasses(){// code }
        public function afficherClasses($limit = null, $offset = null) {
            $db = new Database();
            $conn = $db->connexion();

            if ($limit !== null && $offset !== null) {
                $sql = "SELECT * FROM classe LIMIT :limit OFFSET :offset";
                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            } else {
                $sql = "SELECT * FROM classe";
                $stmt = $conn->prepare($sql);
            }
            $stmt->execute();
              return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        //la suite pour la pajination 
                public function compterClasses(){
                     $db = new Database();
                      $conn = $db->connexion();
                    $sql = "SELECT COUNT(*) FROM classe";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    return $stmt->fetchColumn();
                }
                
   public function ajouterClasse() {
         $db = new Database();
        $conn = $db->connexion();

       $sql="INSERT INTO classe(nom,niveau,filier) 
       VALUES(:nom, :niveau, :filier)";
        
        $stmt=$conn->prepare($sql);

        $stmt->execute([
            ":nom" => $this->nom,
            ":niveau" => $this->niveau,
            ":filier" => $this->filier
        ]);
    }
        //supprimer 
        public function supprimerClasse($id){
              $db = new Database();
              $conn = $db->connexion();

        $sql = "DELETE FROM classe WHERE id = ?";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$id]);
    }
}