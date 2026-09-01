<?php
require_once __DIR__ . "/../models/notes.php";
session_start();

class NotesControllers {
     public function ajouterNote() {
            if($_SERVER['REQUEST_METHOD']== "POST"){
             $type_note= $_POST['type_note'];
             $note= $_POST['note'];
             $id_etudiant= $_POST['id_etudiant'];
             $id_matiere= $_POST['id_matiere'];

             $redirect = $_POST['redirect'] ?? 'admin/notes.php';
             if($type_note === '' || $note === '' || $id_etudiant === '' || $id_matiere === '') {
              $_SESSION['erreur']="veuillez remplir tous les champs !";
                  header('location:../views/' . $redirect);
                     exit();
                }
             $notesModels = new Notes($type_note, $note, $id_etudiant, $id_matiere);
             $notesModels->notes();
                 header('location:../views/' . $redirect);
                  exit();
        }
     }

    public function afficherNotes() {
        $id_etudiant = $_SESSION['id'];
        $notesModels = new Notes("", "", "", "");
        $notes = $notesModels->afficherNotesEtudiant($id_etudiant);

        return $notes;
    }
    public function supprimerNotes($id) {
        // $id=$_GET['id'];
         $notesModels = new Notes(null, null, null, null);
         $notesModels->supprimerNote($id);
         header('Location: ../views/admin/notes.php');
          exit();
    }
}
if($_SERVER['REQUEST_METHOD']== "POST"){
    $notesnmbr1= new NotesControllers();
    $notesnmbr1->ajouterNote();
}elseif ($_SERVER['REQUEST_METHOD']== "GET" && isset($_GET['id']) && $_GET['action']=== 'supprimer') {
    $notesnmbr1= new NotesControllers();
    $notesnmbr1->supprimerNotes($_GET['id']);
}