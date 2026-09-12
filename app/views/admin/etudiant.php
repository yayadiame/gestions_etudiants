<?php
// session_start();
require_once __DIR__ . "/../composants/nav.php";
require_once __DIR__ . "/../composants/header.php";
require_once __DIR__ . "/../../models/etudiant.php";
require_once __DIR__ . "/../../models/classe.php";

$etudiant = new Etudiant("", "");
$classeModels = new Classe("", "", "");
$classes = $classeModels->afficherClasses();
$limit = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$liste = $etudiant->afficherEtudiants($limit, $offset);
$totalPages = max(1, (int) ceil($etudiant->compterEtudiants() / $limit));

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $limit;
    $liste = $etudiant->afficherEtudiants($limit, $offset);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/etudiant.css">
</head>
<body>
    <section class="section_etudiant">
         <div class="page-header">
            <h1>Gestion des etudiants</h1>
            <p>Consultez et gérez vos étudiants.</p>
        </div>
        <div class="filter_etudiant">
            <input type="text" id="search" placeholder="filtrez par nom .....">
            <div class="div-exprts">
                <button class="addEtudiant"><i class="fa-solid fa-user-plus"></i> Ajouter Etudiant</button>
                <button class="exports"><a class="exports" href="../../controllers/EtudiantControllers.php?action=exporter"><i class="fa-solid fa-file-export"></i> Exports</a></button>
            </div>
        </div>
        <div class="form_etudiant">
            <form action="../../controllers/EtudiantControllers.php" method="POST">
                <div class="crois">
                    <h3>Creer Etudiant</h3>
                    <p><strong class="crois_X  btnreser">X</strong></p>
                </div>
                <!-- <input type="file"> -->
                <label for="">Nom complet</label> <br>
                <input type="text" name="nom" required> 
                <label for="">Email</label> <br>
                <input type="email" name="email" required> 
                <label>Classe</label>
                <select name="id_classe" required>
                    <option value=""></option>
                    <?php foreach ($classes as $classe): ?>
                        <option value="<?= $classe['id'] ?>">
                            <?= htmlspecialchars($classe['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="flex-etudiant">
                    <button class="btnreser">Annuler</button>
                    <button class="btnadd" type="submit">Ajouter Etudiant</button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>profil</th>
                    <th>nom</th>
                    <th>email</th>
                    <th>Classe</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($liste)) : ?>
                    <?php foreach ($liste as $e) : ?>
                        <tr>
                            <td>👤</td>
                            <td><?= htmlspecialchars($e['nom'] ?? '') ?></td>
                            <td><?= htmlspecialchars($e['email'] ?? '') ?></td>
                            <td><?= htmlspecialchars($e['nom_classe'] ?? '') ?></td>
                            <td class="flex-icones">
                                <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="../../controllers/EtudiantControllers.php?action=supprimer&email=<?= urlencode($e['email']) ?>" onclick="return confirm('Confirmer pour supprimer')">
                                    <i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Aucun étudiant trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($totalPages > 1): ?>
        <div class="pagination" aria-label="Pages des étudiants">
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
<script src="../../public/javascript/etudiant.js"></script>
</html>