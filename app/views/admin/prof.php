<?php
require_once __DIR__ . "/../composants/nav.php";
require_once __DIR__ . "/../composants/header.php";
require_once __DIR__ . "/../../models/prof.php";
$profs = new Prof("", "");
$limit = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$listers = $profs->afficherProf($limit, $offset);
$totalPages = max(1, (int) ceil($profs->compterProf() / $limit));

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $limit;
    $listers = $profs->afficherProf($limit, $offset);
}
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
         <div class="page-header">
            <h1>Gestion des enseignats</h1>
            <p>Consultez et gérez vos enseignats.</p>
        </div>
        </div>
        <div class="filter_prof">
            <input type="text" id="search" placeholder="filter par nom.....">
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
                <!-- <td> 👤</td> -->
                 <td><?php
                $nom = trim($values['nom']);
                $mots = explode(' ', $nom);

                if (count($mots) >= 2) {
                    $initiales = strtoupper(
                        substr($mots[0], 0, 1) .
                        substr($mots[1], 0, 1)
                    );
                } else {
                    $initiales = strtoupper(substr($nom, 0, 2));
                }
                ?>
                <div class="card-note">
                    <div class="avatar">
                        <?= htmlspecialchars($initiales) ?>
                    </div>
                </td>
                <td> <?= $values['nom'] ?></td>
                <td> <?= $values['email'] ?></td>
                <td class="flex-icones">
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../../controllers/ProfControllers.php?action=supprimer&email=<?= urlencode($values['email']) ?>"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($totalPages > 1): ?>
        <div class="pagination" aria-label="Pages des enseignants">
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
<script src="../../public/javascript/prof.js"></script>
</html>