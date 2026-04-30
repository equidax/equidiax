<?php 

session_start();
require 'src/script/_script.php';
if(!isset($_SESSION['id_user'])) {
    header('Location: src/script/_Disconnect.php');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique</title>
		<link rel="icon" href="src/img/lechevalctrogénial.png" />
		<link rel="stylesheet" href="src/styles/style.css" />
        <link rel="stylesheet" href="src/styles/infos.css" />
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

    <!-- Contenu de la page -->
    <?php
    if(isset($_SESSION['id_user'])) {

        // On récupère les informations de l'utilisateur connecté
        $request_user_info = $bdd->prepare('SELECT * FROM utilisateur WHERE Id_Utilisateur = ?');
        $request_user_info->execute([$_SESSION['id_user']]);

        while($data = $request_user_info->fetch()) {
            $type_account = $data['type_compte'];
            
            if($type_account == "g" || $type_account == "v") {
                // On récupère les informations de la course en fonction de l'ID de la course passé en paramètre dans l'URL
                if(isset($_GET['id_course'])) {
                    $id_course = htmlspecialchars($_GET['id_course']);
                    $request_course_info = $bdd->prepare('SELECT * FROM course WHERE Id_Course = ?');
                    $request_course_info->execute([$id_course]);

                    while($data_course = $request_course_info->fetch()) {
                        $date_course = $data_course['date_'];
                        $lieu_course = $data_course['lieu'];
                        $nbr_places_restantes = $data_course['place_Restante'];
                        $nbr_places_max = $data_course['nbr_Max_Place'];
                        $nbr_places_prises = $nbr_places_restantes;
                    }
                } else {
                    header('Location: courses.php');
                }
            ?>
            <div class="infos_course">
            <h2>Course le <?php if(isset($date_course)) {echo date("d/m/Y à H\hi", strtotime($date_course));} ?></h2>
            <?php
                $today = new DateTime();
                $dateJ = new DateTime($date_course);

                $interval = $today->diff($dateJ);

                $jours = $interval->days;

                if ($interval->invert) {
                    echo "La date est passée de $jours jours";
                } else {
                    echo "Il reste $jours jours";
                }
            ?>
            <form action="" method="post">
                <div class="input_donnees">
                    <div class="lieu">
                        <label for="lieu">Lieu de la course : </label>
                        <input type="text" name="lieu" id="lieu" value="<?php if(isset($lieu_course)) {echo $lieu_course;} ?>" required <?php if($type_account == "v") { echo "disabled"; } ?>>
                    </div>
                    <div class="date">
                        <label for="date">Date de la course : </label>
                        <input type="datetime-local" name="date" id="date" value="<?php if(isset($date_course)) {echo date("Y-m-d\TH:i", strtotime($date_course));} ?>" required <?php if($type_account == "v") { echo "disabled"; } ?>>
                    </div>
                    <div class="place">
                        <label for="nbr_places">Nombre de places : </label>
						<input type="number" name="nbr_places" id="nbr_places" value="<?php if(isset($nbr_places_restantes)) {echo $nbr_places_restantes;} ?>" required <?php if($type_account == "v") { echo "disabled"; } ?>>
                    </div>
                    <div class="place_reste">
                        <label for="nbr_places_reste">Nombre de places restantes : </label>
                        <?php if(isset($nbr_places_prises)) {echo $nbr_places_prises;} ?>
                    </div>
                </div>
                <?php 
                if($type_account == "g") {
                ?>
                <div class="btn">
                    <div class="btn-del">
                        <button type="submit" name="delete_course">Supprimer la course</button>
                    </div>
                    <div class="btn-save">
                        <button type="submit" name="save_course">Enregistrer les modifications</button>
                    </div>
                </div>
                <?php
                } elseif ($type_account == "v") {
                    ?>
                    <div class="btn">
                        <div class="btn-jockey">
                            <button name="delete_course"><a style="color: #000; text-decoration: none;" href="jockey.php">devenir jockey</a></button>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </form>
            </div>
            <?php
            if(isset($_POST['delete_course'])) {
                header('Location: src/script/_Delete_course.php?id_course=' . $id_course);
            } elseif(isset($_POST['save_course'])) {
                $new_lieu = htmlspecialchars($_POST['lieu']);
                $new_date = htmlspecialchars($_POST['date']);
                $new_nbr_places = htmlspecialchars($_POST['nbr_places']);

                // Requête de mise à jour de la course
                $request_update_course = $bdd->prepare('UPDATE course SET lieu = ?, date_ = ?, place_Restante = ? WHERE Id_Course = ?');
                $request_update_course->execute([$new_lieu, $new_date, $new_nbr_places, $id_course]);

                $_SESSION['message'] ="<div style='color: green;' class='message'>" . "Course mise à jour..." . "</div>";
                header('Location: courses.php');
            }
        }
        }

    }
    ?>


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