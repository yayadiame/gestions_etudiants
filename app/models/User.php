<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

class User{
    private $connector;
    public function __construct() {
        $db = new Database();
        $this->connector = $db->connexion();
    }
    public function lecteurUser($email){
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connector->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}











// class User{
//     private $conns;
//     public function __construct() {
//         $db=new Datebase();
//         $this->conns=$db->connector();
//     }
//     public function listerUser(){
//         $sql="SELECT * FROM user ";
//         $stmt=$this->conns->prepare($sql);
//         $stmt->execute();
//         $users=$stmt->fetchAll();
//         return $users;
//     }
// }