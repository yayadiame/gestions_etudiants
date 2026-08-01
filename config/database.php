<?php
class Database{
    private $host="localhost";
    private $password="";
    private $user="root";
    private $dbname="gestions_etudiants";

    public function connexion(){
        try {
            $db = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->user,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            return $db;
        } catch (\Throwable $e) {
            echo "Erreur de connexion: " . $e->getMessage();
            return null;
        }
    }
}