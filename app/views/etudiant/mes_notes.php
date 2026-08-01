<?php
require_once (__DIR__ . "../../composants/nav.php");
require_once (__DIR__ . "../../composants/header.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/notes.css">
</head>
<body>
    <section class="mes_notes">
        <h2>Consulter mes notes</h2>
        <table>
            <th>Matiere</th>
            <th>Coefficient</th>
            <th>Devoir</th>
            <th>Examen</th>
            <th>Moyenne</th>
            <tr>
                <td>javascript</td>
                <td>4</td>
                <td>6</td>
                <td>15</td>
                <td>11</td>
            </tr>
            <tr>
                <td>css</td>
                <td>4</td>
                <td>5</td>
                <td>15</td>
                <td>13</td>
            </tr>
            <tr>
                <td>algorithme</td>
                <td>4</td>
                <td>15</td>
                <td>5</td>
                <td>13</td>
            </tr>
        </table>
    </section>
</body>
</html>