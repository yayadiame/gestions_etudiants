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
    <link rel="stylesheet" href="../../public/css/absences.css">
</head>
<body>
    <section class="mes-absences">
        <h3 class="h3h3">Consulter votre Absences</h3>
        <div class="demande-absences">
            <input type="text" class="absencesinput" placeholder="filter...">
            <div class="absecesEtudiant">
                <select name="" id="">
                    <option value="">--status--</option>
                    <option value="">validé</option>
                    <option value="">refusé</option>
                    <option value="">en attente</option>
                </select>
                <button onclick= "location.reload()">Recharger</button>
                <button class="AddAbcenses">Demande Absences</button>
            </div>
        </div>
        <div class="formAbsences">
            <form action="" method="post">
                <div class="flexDmnd">
                    <h3>Demande d'absences</h3>
                    <div class="crois">X</div>
                </div>
                <label>Nom Complet</label>
                <input type="text" placeholder="Ex: yaya diallo">
                <label>Telephone</label>
                <input type="number" placeholder="Ex: 00 000 00 00">
                <label>Motif</label>
                <textarea name="" id=""></textarea>
                <div class="btnDmnd">    
                    <button class="btnreset" type="reset">Annuler</button>
                    <button type="submit">Demander</button>
                </div>
            </form>
        </div>
        <!-- <section class="card-etudiant">
            <div class="box">
                <img src="" alt="">
                <div class="box-nom">
                    <p>nom:yaya diallo</p>
                    <p>email</p>
                </div>
            </div>
        </section> -->
    </section>
</body>
<script src="../../public/javascript/absences.js"></script>
</html>