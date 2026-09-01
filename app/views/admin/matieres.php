<?php
require_once __DIR__ . "../../composants/nav.php";
require_once __DIR__ . "../../composants/header.php";
// partie prof 
require_once __DIR__ . "/../../models/prof.php";
$profs = new Prof("", "");
$listers = $profs->afficherProf();
//matieres
require_once __DIR__ . "/../../models/matieres.php";
$matieresModels = new Matieres("", "", "");
$limit = 2;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$matieres = $matieresModels->afficherMatieres($limit, $offset);
$totalPages = max(1, (int) ceil($matieresModels->compterMatieres() / $limit));

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $limit;
    $matieres = $matieresModels->afficherMatieres($limit, $offset);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/matieres.css">
</head>
<body>
    <section class="parti_matieres">
         <div class="page-header">
            <h1>Gestion des matieres</h1>
            <p>Consultez et gérez vos Matieres.</p>
        </div>
        <div class="flex-h2">
            <h3>Tableau des Matieres</h3>
            <button class="new_matieres">Creer Matieres</button>
        </div>
        <div class="form_matieres">
            <form action="../../controllers/MatieresControllers.php" method="POST">
                <div class="flex_modal">
                    <h3>Ajouter une matière</h3>
                    <p class="crois">X</p>
                </div>
                <input class="input" name="nom" type="text" placeholder="Ex:html" required>
                <select name="id_prof" id="">
                    <option value="">--prof--</option>
                    <?php foreach ($listers as $prof): ?>
                    <option value="<?= $prof['id'] ?>">  <?= htmlspecialchars($prof['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="coefficient" placeholder="Ex :coef 4" required min="1" max="10">
                <div class="flex_btn">
                    <button type="button" class="btnreset">Annulere</button>
                    <button class="btnadd" type="submit">Creer Matieres</button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <th>Profil</th>
                <th>nom_matiere</th>
                <th>Coefficient</th>
                <th>Enseignants</th>
                <th>Action</th>
            </thead>
            <?php foreach ($matieres as $M): ?>
            <tr>
                <td>👤</td>
                <td><?= $M['nom'] ?></td>
                <td><?= $M['coefficient'] ?></td>
                <td><?= $M['nom_prof'] ?></td>
                <td class="flex-icones">
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../../controllers/MatieresControllers.php?action=supprimer&id=<?= urlencode($M['id']) ?>"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php if ($totalPages > 1): ?>
        <div class="pagination" aria-label="Pages des matières">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" aria-label="Page précédente">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            <?php endif; ?>

            <?php for ($numero = 1; $numero <= $totalPages; $numero++): ?>
                <a href="?page=<?= $numero ?>" class="<?= $numero === $page ? 'active' : '' ?>">
                    <?= $numero ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>" aria-label="Page suivante">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
</body>
<script src="../../public/javascript/matieres.js"></script>
</html>