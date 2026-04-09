<?php

session_start();
include 'src/script/_script.php';

if(!isset($_SESSION['id_user'])) {
    header('Location: src/script/_Disconnect.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIDIAX | Ajouter une course</title>
    <link rel="icon" href="src/img/lechevalctrogénial.png" />
	<link rel="stylesheet" href="src/styles/style.css" />
	<link rel="stylesheet" href="src/styles/profil.css" />
</head>
<body>
    <!-- Navigation -->
    <nav>
        <img src="src/img/logo blanc.png" alt="Logo du site" class="logo" />
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="courses.php">Course</a></li>
            <?php
            if (isset($_SESSION['id_user'])) {
            ?>
            <li><a href="profil.php">compte</a></li>
            <?php
            } else {
            ?>
            <li><a href="Connection.php">connexion</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>

    <!-- contenu de la page -->
    <div class="container">
        <h1 class="title">Ajouter une course</h1>
        <!-- Formualire de création de course -->
        <form action="src/script/_Add_courses.php" class="form_add_courses" method="post">
            <div class="input_date">
                <label for="date_course">Date de la course : </label>
                <input type="datetime-local" name="date_course" id="date_course" required>
            </div>
            <div class="input_place">
                <label for="place">Lieu de la course : </label>
                <input type="text" name="place" id="place"required>
            </div>
            <div class="input_nbr_places">
                <label for="nbr_places">Nombre de places : </label>
                <input type="number" name="nbr_places" id="nbr_places" required>
            </div>

            <div class="add_btn">
                <button type="submit">ajouter la course</button>
            </div>
        </form>
    </div>

    <footer class="footer">
        <div class="social-media">
            <a href="https://instagram.com"><img src="src/img/instagram.png" alt="logo instagram"></a>
            <a href="https://tiktok.com"><img src="src/img/tiktok.png" alt="logo tiktok"></a>
            <a href="https://youtube.com"><img src="src/img/youtube.png" alt="logo youtube"></a>
        </div>
        <p>&copy; 2026 EQUIDIAX. Tous droits réservés.</p>
    </footer>
</body>
</html>