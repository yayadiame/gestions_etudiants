<?php
// session_start();
require_once __DIR__ . "/../composants/nav.php";
require_once __DIR__ . "/../composants/header.php";
require_once __DIR__ . "/../../models/etudiant.php";

$etudiant = new Etudiant("", "");
$liste = $etudiant->afficherEtudiants();
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
        <div class="filter_etudiant">
            <input type="text">
            <button class="addEtudiant">Ajouter Etudiant</button>
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
                            <td>—</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Aucun étudiant trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</body>
<script src="../../public/javascript/etudiant.js"></script>
</html>