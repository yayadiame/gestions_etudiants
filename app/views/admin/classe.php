<?php
// session_start();
require_once __DIR__ . "/../composants/nav.php";
require_once __DIR__ . "/../composants/header.php";
require_once __DIR__ . "/../../models/classe.php";

$classeModels = new Classe("", "", "");
// Nombre de classes par page
$limit = 4;
// Page actuelle
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
// Empêcher d'avoir une page 0 ou négative
if ($page < 1) {
    $page = 1;
}
// Calcul de l'offset
$offset = ($page - 1) * $limit;
// Récupérer les classes de la page actuelle
$classes = $classeModels->afficherClasses($limit, $offset);
// Nombre total de classes
$totalClasses = $classeModels->compterClasses();
// Nombre total de pages
$totalPages = ceil($totalClasses / $limit);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
     <link rel="stylesheet" href="../../public/css/classe.css">
</head>
<body>
    <div class="contenair_classe">
         <div class="page-header">
            <h1>Gestion des classes</h1>
            <p>Consultez et gérez votres classes.</p>
        </div>
        <div class="cardAjout">
            <form action="../../controllers/ClasseControllers.php" method="POST">
                 <div class="flex">
                    <h4>Ajouter une classe</h4>
                    <p><strong class="crois">X</strong></p>
                 </div>
                <input type="text" name="nom" placeholder="Nom de la classe" required>
                <select name="niveau" id="niveau" required>
                    <option value="">-- Sélectionner un niveau --</option>
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                </select>
                <input type="text" name="filier" placeholder="Filier" required>
                <div class="button">
                    <button class="btnreset" >Annuler</button>
                    <button class="btnadd"type="submit">+ Nouvelle classe</button>
                </div>
            </form>
        </div>
        <div class="filtere">
            <input type="text" id="search" class="input_filter" placeholder="filter par nom ...">
            <button class="addClasse"><i class="fa-solid fa-school"></i>  add classes</button>
        </div>
        <div class="table">
        <table>
            <thead>
                <th>Nom de la classe</th>
                <th>Filier</th>
                <th>Niveau</th>
                <th>action</th>
            </thead>
            <?php foreach($classes as $classe) : ?>
            <tr>
                <td><?= $classe['nom'] ?></td>
                <td><?= $classe['filier'] ?></td>
                <td><?= $classe['niveau'] ?></td>
                <td class="flex-icones">
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../../controllers/ClasseControllers.php?action=supprimer&id=<?= $classe['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php endforeach ;?>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a  href="?page=<?= $i ?>"class="<?= ($i == $page) ? 'active' : '' ?>"> <?= $i ?> </a>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-chevron-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
    </div>
</body>
<script src="../../public/javascript/classe.js"></script>
</html>
