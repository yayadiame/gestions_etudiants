<?php
class Database{
    private $host="localhost";
    private $password="";
    private $user="root";
    private $dbname="gestions_etudiants";

    public function connexion(){
        try {
            // $options = [
            //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //     PDO::ATTR_EMULATE_PREPARES => false,
            // ];

            $db = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->user,
                $this->password
                // $options
            );

            return $db;
        } catch (PDOException $e) {
            echo "Erreur de connexion: " . $e->getMessage();
            return null;
        }
    }
}