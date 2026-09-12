<?php
require_once (__DIR__ . "/../composants/nav.php");
require_once (__DIR__ . "/../composants/header.php");
require_once __DIR__ . "/../../models/mes_absences.php";

$absencesModel = new Absence("", "", "");
$absences = $absencesModel->afficherAbsencesProf($_SESSION['id'] ?? 0);
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
    <title>Gestion des absences</title>
</head>
 <style>
        .container {
            margin-left: 19%;
            width: 79.8%;
            margin-top: 10px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background-color: #fff;
            padding: 20px;
        }

        .page-header h1 {
            font-size: 28px;
            margin-bottom: 6px;
            color:  #092d64ee;
        }

        .page-header p {
            color:  #092d64ee;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .stat-card strong {
            font-size: 28px;
        }

        .filters {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
        }

        .filters input,
        .filters select {
            padding: 11px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            width: 350px;
        }
        .filters input:focus,
        .filters select:focus{
            outline: none;
           border-color: #092d64af;
        }
        .table-container {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
        }
        .filters button{
            background-color: #092d64ee;
            padding: 0 25px;
            border-radius: 12px;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background:  #092d64ee;
        }

        th,
        td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            font-size: 14px;
            color:white;
        }

        td {
            font-size: 14px;
        }

        .student {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .attente {
            background: #fff7ed;
            color: #c2410c;
        }

        .acceptee {
            background: #ecfdf5;
            color: #047857;
        }

        .refusee {
            background: #fef2f2;
            color: #b91c1c;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            border: none;
            padding: 8px 12px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-accept {
            background: #10b981;
            color: white;
        }

        .btn-refuse {
            background: #ef4444;
            color: white;
        }

        .btn-accept:hover {
            background: #059669;
        }

        .btn-refuse:hover {
            background: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #6b7280;
        }

        @media (max-width: 900px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .page-header h1 {
                font-size: 22px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .filters {
                flex-direction: column;
            }

            .filters input,
            .filters select {
                width: 100%;
            }
        }
    </style>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <h1>Gestion des absences</h1>
            <p>Consultez et gérez les demandes d'absence de vos étudiants.</p>
        </div>
    </div>
    <!-- STATISTIQUES -->
    <?php
        $total = count($absences);

        $enAttente = 0;
        $acceptees = 0;
        $refusees = 0;

        foreach ($absences as $absence) {
            if ($absence['statut'] === 'en_attente') {
                $enAttente++;
            }
            if ($absence['statut'] === 'acceptee') {
                $acceptees++;
            }
            if ($absence['statut'] === 'refusee') {
                $refusees++;
            }
        }
    ?>
    <div class="stats">
        <div class="stat-card">
            <h3>Total des absences</h3>
            <strong><?= $total ?></strong>
        </div>

        <div class="stat-card">
            <h3>En attente</h3>
            <strong><?= $enAttente ?></strong>
        </div>

        <div class="stat-card">
            <h3>Acceptées</h3>
            <strong><?= $acceptees ?></strong>
        </div>
        <div class="stat-card">
            <h3>Refusées</h3>
            <strong><?= $refusees ?></strong>
        </div>
    </div>
    <!-- FILTRES -->
    <div class="filters">
        <input type="text" id="search" placeholder="Rechercher un étudiant...">
        <select id="statutFilter">
            <option value="">Tous les statuts</option>
            <option value="en_attente">En attente</option>
            <option value="acceptee">Acceptées</option>
            <option value="refusee">Refusées</option>
        </select>
        <button onclick="filtrer()">Filtrer</button>
        <button onclick="location.reload()"><i class="fa-solid fa-arrows-rotate"></i> Recharger</button>
    </div>
    <!-- TABLE -->
    <div class="table-container">
            <table id="absenceTable">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Matière</th>
                    <th>Motif</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($absences as $absence): ?>
                <tr data-statut="<?= htmlspecialchars($absence['statut']) ?>">
                    <!-- ETUDIANT -->
                    <td>
                        <div class="student">
                            <div class="avatar">
                                <?= strtoupper(substr($absence['nom_etudiant'],0,1)) ?>
                            </div>
                            <span>
                                <?= htmlspecialchars(
                                    $absence['nom_etudiant']
                                ) ?>
                            </span>
                        </div>
                    </td>
                    <!-- MATIERE -->
                    <td>
                        <?= htmlspecialchars(
                            $absence['nom_matiere']
                        ) ?>
                    </td>
                    <!-- MOTIF -->
                    <td>
                        <?= htmlspecialchars(
                            $absence['motif']
                        ) ?>
                    </td>
                    <!-- DATE -->
                    <td>
                        <?= htmlspecialchars(
                            $absence['date_absence']
                        ) ?>
                    </td>
                    <!-- STATUT -->
                    <td>
                        <?php if ($absence['statut'] === 'en_attente'): ?>
                            <span class="badge attente">
                                En attente
                            </span>
                        <?php elseif ($absence['statut'] === 'acceptee'): ?>
                            <span class="badge acceptee">
                                Acceptée
                            </span>
                        <?php else: ?>
                            <span class="badge refusee">
                                Refusée
                            </span>
                        <?php endif; ?>
                    </td>
                    <!-- ACTIONS -->
                    <td>
                        <?php if ($absence['statut'] === 'en_attente'): ?>
                            <div class="actions">
                                <form method="POST" action="../../controllers/AbsencesControllers.php">
                                    <input type="hidden" name="action" value="accepter">
                                    <input type="hidden" name="id" value="<?= $absence['id'] ?>">
                                    <button type="submit" class="btn btn-accept">
                                        Accepter
                                    </button>
                                </form>
                                <form method="POST" action="../../controllers/AbsencesControllers.php">
                                    <input type="hidden" name="action" value="refuser">
                                    <input type="hidden" name="id" value="<?= $absence['id'] ?>">
                                    <button type="submit" class="btn btn-refuse">Refuser</button>
                                </form>
                            </div>
                        <?php elseif($absence['statut'] === 'acceptee'): ?> 
                            <span> Acceptée</span>
                            <?php else: ?> 
                                <span> refusé</span>
                            <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
<script src="../../public/javascript/absences_prof.js"></script>
</html> 