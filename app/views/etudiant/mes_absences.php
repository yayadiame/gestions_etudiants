<?php
require_once __DIR__ . "/../composants/nav.php";
require_once __DIR__ . "/../composants/header.php";

require_once __DIR__ . "/../../models/mes_absences.php";

$absencesModel = new Absence("", "", "");
$absences = $absencesModel->afficherAbsences($_SESSION['id'] ?? 0);
//matieres
require_once __DIR__ . "/../../models/matieres.php";
$matieresModels = new Matieres("", "", "");
$matieres =$matieresModels-> afficherMatieres();
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
            
            <form action="../../controllers/AbsencesControllers.php" method="POST">
                <input type="hidden" name="id_etudiant" value="<?php echo isset($_SESSION['id']) ? htmlspecialchars($_SESSION['id']) : ''; ?>">
                <div class="flexDmnd">
                    <h3>Demande d'absences</h3>
                    <div class="crois">X</div>
                </div>
                <label>Matieres <span style="color: red;">*</span></label>
                <select name="id_matiere" required>
                    <option value="">-- Sélectionnez une matière --</option>
                    <?php if (empty($matieres)): ?>
                        <option disabled>Aucune matière disponible</option>
                    <?php else: ?>
                        <?php foreach ($matieres as $matiere): ?>
                            <option value="<?= htmlspecialchars($matiere['id']) ?>">
                                <?= htmlspecialchars($matiere['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <label>Motif <span style="color: red;">*</span></label>
                <textarea name="motif" required placeholder="Expliquez la raison de votre absences"></textarea>
                <div class="btnDmnd">    
                    <button class="btnreset" type="reset">Annuler</button>
                    <button type="submit">Demander</button>
                </div>
            </form>
        </div>
        
    </section>
    <section class="absencesA">
         <div class="absences-grid">
            <?php foreach ($absences as $absence): ?>
                <div class="absence-card">
                    <div class="absence-header">
                        <div class="matiere-info">
                            <div>
                                <h3>
                                    <?= htmlspecialchars($absence['nom_matiere']) ?>
                                </h3>
                                <span class="absence-label"> Demande d'absence</span>
                            </div>
                        </div>
                        <span class="statut <?= htmlspecialchars($absence['statut']) ?>">
                            <?= htmlspecialchars($absence['statut']) ?>
                        </span>
                    </div>
                    <div class="absence-content">
                        <div class="info-item">
                            <div>
                                <small>Date</small>
                                <p>
                                    <?= htmlspecialchars($absence['date_absence']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div>
                                <small>Motif</small>
                                <p>
                                    <?= htmlspecialchars($absence['motif']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
<script src="../../public/javascript/absences.js"></script>
</html>