<?php
require_once (__DIR__ . "../../composants/nav.php");
require_once (__DIR__ . "../../composants/header.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/prof.css">
</head>
<body>
    <section class="section_prof">
        <div class="card_prof">

        </div>
        <div class="filter_prof">
            <input type="text">
            <button class="addprof">Ajouter Enseignant</button>
        </div>
        <div class="form_prof">
            <form action="">
                <div class="crois">
                    <h3>Creer Enseignant</h3>
                    <p><strong class="crois_X  btnreser">X</strong></p>
                </div>
                <!-- <input type="file"> -->
                <label for="">Nom complet</label> <br>
                <input type="text"> 
                <label for="">Telephone</label> <br>
                <input type="number">
                <label for="">Email</label> <br>
                <input type="email"> 
                <div class="flex-prof">
                    <button class="btnreser">Annuler</button>
                    <button class="btnadd" type="button">Ajouter Etudiant</button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <th>profil</th>
                <th>nom</th>
                <th>email</th>
                <th>action</th>
            </thead>
            <tr>
                <td></td>
                <td>yaya diallo</td>
                <td>yayad3972@gmail.com</td>
                <td>
                    <button>modifier</button>
                    <button>supprimer</button>
                </td>
            </tr>
        </table>
    </section>
</body>
<script src="../../public/javascript/prof.js"></script>
</html>