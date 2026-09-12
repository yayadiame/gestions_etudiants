<?php
require_once __DIR__ . "../../composants/nav.php";
require_once __DIR__ . "../../composants/header.php";
//prof
require_once __DIR__ . "/../../models/prof.php";
$profs = new Prof("", "");
$listers = $profs->afficherProf();
//matieres
require_once __DIR__ . "/../../models/matieres.php";
$matieresModels = new Matieres("", "", "");
$matieres = $matieresModels->afficherMatieres();
//classes
require_once __DIR__ . "/../../models/classe.php";
$classeModels = new Classe("", "", "");
$classes = $classeModels->afficherClasses();
//planning
require_once __DIR__ . "/../../models/emploi_du_temps.php";
$planningModels = new Planning("", "", "", "", "", "");
$limite = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$debut = ($page - 1) * $limite;
$plannings = $planningModels->afficherPlanning(null, $limite, $debut);
$nombrePages = max(1, (int) ceil($planningModels->compterPlanning() / $limite));
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
            <h3>Gestions des Emploi du temps</h3>
            <button class="new_planning">Creer Planning</button>
        </div>
        <div class="form_planning">
            <form action="../../controllers/PlanningControllers.php" method="post">
                <div class="flex">
                    <h3 class="h3">Creer emploi du temps</h3>
                    <p class="crois">X</p>
                </div>
                <div class="selecte"> 
                    <div>
                        <select name="id_classe" id="">
                            <option value="">--classe--</option>
                            <?php foreach($classes as $classe) : ?>
                            <option value="<?= $classe['id'] ?>"><?= $classe['nom'] ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div>
                        <select name="jour" id="">
                            <option value="">--jour--</option>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                        </select>
                    </div>
                    <div>
                        <select name="id_matiere" id="">
                            <option value="">--Matiere--</option>
                            <?php foreach ($matieres as $M): ?>
                            <option value="<?= $M['id'] ?>"><?= $M['nom'] ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div>
                        <select name="id_prof" id="">
                            <option value="">--Enseignants--</option>
                            <?php foreach($listers as $values):?>
                            <option value="<?= $values['id'] ?>"><?= $values['nom'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="time">
                    <div>
                        <input name="heure_debut" type="time" placeholder="heur de debut">
                    </div>
                    <div>
                        <input name="heure_fin" type="time" placeholder="heur de fin">
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
                <th>Enseignants</th>
                <th>Action</th>
            </thead>
             <?php foreach($plannings as $Temps):?>
            <tr>
                <td> <?= htmlspecialchars($Temps['jour']) ?></td>
                <td> <?= htmlspecialchars($Temps['classe']) ?></td>
                <td> <?= htmlspecialchars($Temps['matiere']) ?></td>
                <td> <?= htmlspecialchars($Temps['heure_debut']) ?></td>
                <td> <?= htmlspecialchars($Temps['heure_fin']) ?></td>
                <td> <?= htmlspecialchars($Temps['professeur']) ?></td>
                <td class="flex-icones">
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../../controllers/PlanningControllers.php?action=supprimer&id=<?= $Temps['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
             <?php endforeach; ?>
        </table>
        <?php if ($nombrePages > 1): ?>
        <nav class="pagination" aria-label="Pages des emplois du temps">
            <?php for ($numero = 1; $numero <= $nombrePages; $numero++): ?>
                <a href="?page=<?= $numero ?>" class="<?= $numero === $page ? 'active' : '' ?>"><?= $numero ?></a>
            <?php endfor; ?>
        </nav>
        <?php endif; ?>
    </section>
</body>
<script src="../../public/javascript/planning.js"></script> 
</html>
