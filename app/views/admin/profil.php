<?php
// session_start();
require_once __DIR__ . "../../composants/nav.php";
require_once __DIR__ . "../../composants/header.php";
require_once "../../models/profil.php";

$profil = new Profil();

$id = $_SESSION["id"];

$user = $profil->afficherProfil($id);

// Déterminer l'URL de la photo de profil (par défaut puis recherche dans /public/uploads)
$photoUrl = '../../public/profil.jpg';
$uploadsDir = __DIR__ . '/../../public/uploads/';
if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];
    $files = glob($uploadsDir . 'user_' . $uid . '.*');
    if ($files && count($files) > 0) {
        $photoUrl = '../../public/uploads/' . basename($files[0]);
    } elseif (!empty($_SESSION['photo'])) {
        $photoUrl = '../../' . $_SESSION['photo'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Paramètres du profil</title>

    <link rel="stylesheet" href="style.css">
</head>
<style>
.profile-card {
    max-width: 750px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
}

.profile-title {
    margin-bottom: 20px;
}

.profile-title h2 {
    margin: 0 0 6px;
    font-size: 24px;
    color: #222;
}

.profile-title p {
    margin: 0;
    color: #888;
    font-size: 14px;
}


/* Photo */

.photo {
    text-align: center;
    padding-bottom: 25px;
    margin-bottom: 25px;
    border-bottom: 1px solid #eee;
}

.photo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #f1f3f5;
    display: block;
    margin: 0 auto 12px;
}

.photo label {
    color: #1b449b;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.photo label:hover {
    text-decoration: underline;
}


/* Champs */

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    color: #333;
    font-size: 14px;
    font-weight: 600;
}

.form-group input {
    width: 100%;
    height: 35px;
    padding: 0 13px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    box-sizing: border-box;
}

.form-group input:focus {
    border-color: #1d3557;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
}


/* Mot de passe */

.password {
    margin-top: 25px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.password h3 {
    margin: 0 0 20px;
    font-size: 17px;
    color: #222;
}


/* Bouton */

.profile-card button {
    width: 100%;
    height: 46px;
    margin-top: 10px;
    border: none;
    border-radius: 8px;
    background: #1d3557;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}

.profile-card button:hover {
    background: #1d3557;
}

.form-row {
    display: flex;
    gap: 20px;
}
.form-row .form-group {
    flex: 1;
}
</style>
<body>
<div class="profile-card">
    <div class="profile-title">
        <h2>Paramètres du profil</h2>
        <p>Modifiez vos informations personnelles</p>
    </div>
    <form action="../../controllers/UserControllers.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update_profile">
        <div class="photo">
            <img src="<?= htmlspecialchars($photoUrl) ?>" alt="Profil">
            <label for="photo">Changer la photo</label>
            <input type="file" id="photo" name="photo" style="display:none;">
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Nom complet</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Profil</label>
            <input type="text" name="profil" value="<?= htmlspecialchars($user['role']) ?>">
        </div>
        <div class="password">
            <h3>Modifier le mot de passe</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Nouveau mot de passe</label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="confirmation">
                </div>
            </div>
        </div>
        <button type="submit"> Enregistrer les modifications</button>

    </form>

</div>
</body>

</html>
<script>
// Ouvrir le sélecteur de fichier quand on clique sur le label
document.addEventListener('DOMContentLoaded', function(){
    const label = document.querySelector('label[for="photo"]');
    const input = document.getElementById('photo');
    const img = document.querySelector('.photo img');
    if (label && input) {
        label.addEventListener('click', function(e){
            e.preventDefault();
            input.click();
        });
    }
    // Prévisualisation locale
    if (input && img) {
        input.addEventListener('change', function(){
            const f = this.files[0];
            if (!f) return;
            const reader = new FileReader();
            reader.onload = function(e){
                img.src = e.target.result;
            };
            reader.readAsDataURL(f);
        });
    }
});
</script>