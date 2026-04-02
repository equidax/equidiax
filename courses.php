<?php
    include 'src/script/_script.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique</title>
		<link rel="icon" href="src/img/lechevalctrogénial.png" />
		<link rel="stylesheet" href="src/styles/style.css" />
		<link rel="stylesheet" href="src/styles/courses.css" />
	</head>
	<body>
		<!-- Navigation -->
		<nav>
			<img src="src/img/logo blanc.png" alt="Logo du site" class="logo" />
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="courses.php">Course</a></li>
				<?php
				session_start();
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

		<div class="container">
            <!-- Les courses disponibles -->
            <?php
            if(isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
            <h1 class="maintitle">Courses disponible</h1>
            <?php
            // Requête pour récupérer les courses disponibles depuis la base de données
            $request_courses = $bdd->query("SELECT * FROM course ORDER BY date_ ASC");
            while($data = $request_courses->fetch()) {

                $id_course = $data['Id_Course'];
                $date_course = $data['date_'];
                $lieu_course = $data['lieu'];
                $nbr_places_restantes = $data['place_Restante'];
                $nbr_places_max = $data['nbr_Max_Place'];
                $nbr_places_prises = $nbr_places_max - $nbr_places_restantes;
                ?>
                <div class="content">
                    <div class="courses">
                        <?php
                        if(isset($_SESSION['type_account'])) {
                            // Vérifier que l'utilisateur est un gestionnaire de course
                            if($_SESSION['type_account'] == "g"){

                                
                                ?>
                                <div class="check">
                                    <!-- Remplacez la valeur de l'input par l'ID de la course correspondante -->
                                    <form action="src/script/_Delete_course.php" method="post">
                                    <input type="checkbox" name="check_course" id="check_course" value="<?php if(isset($id_course)) {echo $id_course;} ?>">
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="date">

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

                        </div>
                        <div class="title">
                            <h2>Course le <?php if(isset($date_course)) {echo date("d/m/Y à H\hi", strtotime($date_course));} ?></h2>
                            <p class="lieu"><?php if(isset($lieu_course)) {echo $lieu_course;} ?></p>
                        </div>
                        <div class="inscription">
                            <?php
                            
                            if(isset($_SESSION['type_account'])) {
                                if($_SESSION['type_account'] == "g") {
                                    ?>
                                    <a href="Infos.php?id_course=<?= $id_course; ?>"><button>informations</button></a>
                                    <?php
                                } elseif($_SESSION['type_account'] == "p") {
                                    ?>
                                    <a href="#"><button>s'inscrire</button></a>
                                    <?php
                                } elseif($_SESSION['type_account'] == "v") {
                                    ?>
                                    <a href="#"><button>informations</button></a>
                                    <?php
                                }
                            } else {
                                header('Location: src/script/_Disconnect.php');
                            }
                            ?>
                            <p class="nbr_participants"><span><?php if(isset($nbr_places_restantes)) {echo $nbr_places_restantes;} ?></span> places restantes</p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
		</div>
        <!-- Permettre au gestionnaire de supprimer une course -->
        <?php 
        if(isset($_SESSION['type_account'])) {
            if($_SESSION['type_account'] == "g") {
                ?>
                <div class="btn-gestion">
                    <button class="btn-del" type="submit">supprimer une course</button>
                    <button class="btn-add"><a href="profil.php">ajouter une course</a></button>
                </div>
                <?php
            } elseif($_SESSION['type_account'] == "p") {
                ?>
                <?php
            } elseif($_SESSION['type_account'] == "v") {
                ?>
                <?php
            }
        }
        ?>
         </form>

        <div class="historique">
            <!-- Les courses passées -->
            <h1 class="title">Historique des courses</h1>
            <div class="content">
                <div class="courses">
                    <div class="date">Il y a 2jrs</div>
                    <div class="title">
                        <h2>Cours du 12 mars 2026</h2>
                        <p class="lieu">Hippodrome de Cholet</p>
                    </div>
                    <div class="resultats">
                        <a href="#"><button>voir les résultats</button></a>
                    </div>
                </div>
            </div>
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