<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$role = $_SESSION["role"] ?? null;

// Récupère le nom du fichier PHP actuel
$page = basename($_SERVER['PHP_SELF']);
?>

<nav>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/nav.css">

    <div class="logo">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Gestion Étudiants</span>
    </div>

    <ul>
        <?php if($role == "admin"){ ?>

            <li>
                <a href="../admin/dashboard_admin.php"
                   class="<?= $page == 'dashboard_admin.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="../admin/etudiant.php"
                   class="<?= $page == 'etudiant.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-users"></i> Étudiants
                </a>
            </li>
            <li>
                <a href="../admin/prof.php"
                   class="<?= $page == 'prof.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-chalkboard-user"></i> Professeurs
                </a>
            </li>
            <li>
                <a href="../admin/classe.php"
                   class="<?= $page == 'classe.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-school"></i> Classes
                </a>
            </li>
            <li>
                <a href="../admin/matieres.php"
                   class="<?= $page == 'matieres.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-book-open"></i> Matières
                </a>
            </li>
            <li>
                <a href="../admin/notes.php"
                   class="<?= $page == 'notes.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-square-poll-vertical"></i> Notes
                </a>
            </li>
            <li>
                <a href="../admin/emploi_du_temps.php"
                   class="<?= $page == 'emploi_du_temps.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-days"></i> Emploi du temps
                </a>
            </li>
            <li>
                <a href="../admin/profil.php"
                   class="<?= $page == 'profil.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gear"></i> Parametres
                </a>
            </li>

        <?php } ?>


        <?php if($role === "prof"){ ?>

            <li>
                <a href="../prof/dashboard_prof.php"
                   class="<?= $page == 'dashboard_prof.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="../prof/nouveauNote.php"
                   class="<?= $page == 'nouveauNote.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-pen-to-square"></i> Notes
                </a>
            </li>

            <li>
                <a href="../prof/absences.php"
                   class="<?= $page == 'absences.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-clipboard-check"></i> Absences
                </a>
            </li>

            <li>
                <a href="../prof/emploi_du_temps.php"
                   class="<?= $page == 'emploi_du_temps.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-week"></i> Emploi du temps
                </a>
            </li>

            <li>
                <a href="../prof/profil.php"
                   class="<?= $page == 'profil.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gear"></i> Parametres
                </a>
            </li>

        <?php } ?>


        <?php if($role == "etudiant"){ ?>

            <li>
                <a href="../etudiant/dashboard_etudiant.php"
                   class="<?= $page == 'dashboard_etudiant.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="../etudiant/mes_notes.php"
                   class="<?= $page == 'mes_notes.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-graduation-cap"></i> Mes notes
                </a>
            </li>

            <li>
                <a href="../etudiant/mon_planning.php"
                   class="<?= $page == 'mon_planning.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-days"></i> Emploi du temps
                </a>
            </li>

            <li>
                <a href="../etudiant/mes_absences.php"
                   class="<?= $page == 'mes_absences.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-user-check"></i> Mes absences
                </a>
            </li>

            <li>
                <a href="../etudiant/profil.php"
                   class="<?= $page == 'profil.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gear"></i> Parametres
                </a>
            </li>

        <?php } ?>

        <br><br><br><br><br>

        <li>
            <a href="../../controllers/logout.php">
                <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
            </a>
        </li>

    </ul>
</nav>
