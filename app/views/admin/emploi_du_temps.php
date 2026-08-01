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
    <link rel="stylesheet" href="../../public/css/planning.css">
</head>
<body>
    <section class="planning">
        <div class="planning_new">
            <h3>Emploi du temps</h3>
            <button class="new_planning">Creer Planning</button>
        </div>
        <div class="form_planning">
            <form action="" method="post">
                <div class="flex">
                    <h3 class="h3">Creer emploi du temps</h3>
                    <p class="crois">X</p>
                </div>
                <div class="selecte"> 
                    <div>
                        <select name="" id="">
                            <option value="">--classe--</option>
                            <option value="">A</option>
                            <option value="">B</option>
                            <option value="">C</option>
                        </select>
                    </div>
                    <div>
                        <select name="" id="">
                            <option value="">--jour--</option>
                            <option value="">L</option>
                            <option value="">M</option>
                            <option value="">M</option>
                            <option value="">J</option>
                            <option value="">V</option>
                            <option value="">S</option>
                        </select>
                    </div>
                    <div>
                        <select name="" id="">
                            <option value="">--Matiere--</option>
                            <option value="">dev web</option>
                            <option value="">ref</option>
                            <option value="">bureautique</option>
                            <option value="">iA</option>
                        </select>
                    </div>
                </div>
                <div class="time">
                    <div>
                        <input type="time" placeholder="heur de debut">
                    </div>
                    <div>
                        <input type="time" placeholder="heur de fin">
                    </div>
                </div>
                <div class="time_btn">
                    <button class="resete" type="button">annuler</button>
                    <button  type="submit">Creer planning</button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <th>Jours</th>
                <th>Classe</th>
                <th>Matiere</th>
                <th>Heur de debut</th>
                <th>Heur de fin</th>
                <th>Action</th>
            </thead>
        </table>
    </section>
</body>
<script src="../../public/javascript/planning.js"></script> 
</html>
