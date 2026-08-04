<?php
require_once __DIR__ . "/../composants/nav.php";
require_once __DIR__ . "/../composants/header.php";
require_once __DIR__ . "/../../models/prof.php";
$profs = new Prof("", "");
$listers = $profs->afficherProf();
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
            <form action="../../controllers/ProfControllers.php" method="POST">
                <div class="crois">
                    <h3>Creer Enseignant</h3>
                    <p><strong class="crois_X  btnreser">X</strong></p>
                </div>
                <!-- <input type="file"> -->
                <label for="nom">Nom complet</label> <br>
                <input id="nom" name="nom" type="text" required> 
                <label for="email">Email</label> <br>
                <input id="email" name="email" type="email" required> 
                <div class="flex-prof">
                    <button class="btnreser" type="button">Annuler</button>
                    <button class="btnadd" type="submit">Ajouter Prof</button>
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
            <?php foreach($listers as $values):?>
            <tr>
                <td> 👤</td>
                <td> <?= $values['nom'] ?></td>
                <td> <?= $values['email'] ?></td>
                <td>—</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>
<script src="../../public/javascript/prof.js"></script>
</html>