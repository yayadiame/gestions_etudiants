<?php
session_start();
$role = $_SESSION['role'];
?>

<nav>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/nav.css">
    <div class="logo">
        <i class="fa-solid fa-graduation-cap"></i><span>Gestion Étudiants</span>
    </div>
    <ul>
        <?php if($role == "admin"){ ?>
            <li><a href="../admin/dashboard_admin.php"><i class="fa-solid fa-gauge-high"></i> Dashboard</a></li>
            <li><a href="../admin/etudiant.php"><i class="fa-solid fa-users"></i> Étudiants</a></li>
            <li><a href="../admin/prof.php"><i class="fa-solid fa-chalkboard-user"></i> Professeurs</a></li>
            <li><a href="../admin/classe.php"><i class="fa-solid fa-school"></i> Classes</a></li>
            <li><a href="../admin/matieres.php"><i class="fa-solid fa-book-open"></i> Matières</a></li>
            <li><a href="../admin/notes.php"><i class="fa-solid fa-square-poll-vertical"></i> Notes</a></li>
            <li><a href="../admin/emploi_du_temps.php"><i class="fa-solid fa-calendar-days"></i> Emploi du temps</a></li>
            <li><a href="../admin/profil.php"><i class="fa-solid fa-id-card"></i> Profil</a></li>
        <?php } ?>

        <?php if($role == "prof"){ ?>
            <li><a href="../prof/dashboard.php"><i class="fa-solid fa-gauge-high"></i> Dashboard</a></li>
            <li><a href="../prof/nouveauNote.php"><i class="fa-solid fa-pen-to-square"></i> Notes</a></li>
            <li><a href="../prof/absences.php"><i class="fa-solid fa-clipboard-check"></i> Absences</a></li>
            <li><a href="../prof/emploi_du_temps.php"><i class="fa-solid fa-calendar-week"></i> Emploi du temps</a></li>
            <li><a href="../prof/profil.php"><i class="fa-solid fa-user-gear"></i> Profil</a></li>
        <?php } ?>

        <?php if($role == "etudiant"){ ?>
            <li><a href="../etudiant/dashboard_etudiant.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="../etudiant/mes_notes.php"><i class="fa-solid fa-graduation-cap"></i> Mes notes</a></li>
            <li><a href="../etudiant/mon_planning.php"><i class="fa-solid fa-calendar-days"></i> Emploi du temps</a></li>
            <li><a href="../etudiant/mes_absences.php"><i class="fa-solid fa-user-check"></i> Mes absences</a></li>
            <li><a href="../etudiant/profil.php"><i class="fa-solid fa-circle-user"></i> Profil</a></li>
        <?php } ?>
        <br><br><br>
        <!-- <br><br><br>
        <br><br><br>
        <br><br><br> -->
        <li><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a></li>
    </ul>
</nav>