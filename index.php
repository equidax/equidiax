<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique</title>
		<link rel="icon" href="src/img/lechevalctrogénial.png" />
		<link rel="stylesheet" href="src/styles/style.css" />
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
			<?php
			include 'src/script/_script.php';
			// Requête pour récupérer les courses disponibles depuis la base de données
			$request_courses = $bdd->query("SELECT * FROM course WHERE date_ >= NOW() ORDER BY date_ ASC");
			$data = $request_courses->fetch();

				$id_course = $data['Id_Course'];
				$date_course = $data['date_'];
				$lieu_course = $data['lieu'];
				$nbr_places_restantes = $data['place_Restante'];
				$nbr_places_max = $data['nbr_Max_Place'];
				$nbr_places_prises = $nbr_places_max - $nbr_places_restantes;
				?>
				
			<div class="card-1">
				<!-- Prochaine course -->
				<img src="src/img/course-1.jpg" alt="Image de course">
				<div class="infos-course">
					<h1 class="title">Course du <?php echo date("d/m/Y", strtotime($date_course)); ?></h1>
					<h3 class="lieu">Hippodrome de <?php echo $lieu_course; ?></h3>
					<h3 class="nbr_participants"><?= $nbr_places_restantes ?> places restantes</h3>
					<?php
					if(isset($_SESSION['type_account'])) {
						?>
					<a href="#"><button>s'inscire</button></a>
					<?php } else { ?>
					<a href="Connection.php"><button>connexion pour s'inscrire</button></a>
					<?php } ?>
				</div>
				<div class="title-infos">
					<h1 class="title">Actualités</h1>
					<p class="text">La prochaine course</p>
				</div>
			</div>
			<div class="card-2">
				<!-- Dernière course enregistrée -->
				<?php
				// Récupérer la denière course passée
				$request_last_course = $bdd->query("SELECT * FROM course WHERE date_ < NOW() ORDER BY date_ DESC LIMIT 1");
				if($data_last_course = $request_last_course->fetch()) {
					$id_last_course = $data_last_course['Id_Course'];
					$date_last_course = $data_last_course['date_'];
					$lieu_last_course = $data_last_course['lieu'];
				} else {
					$date_last_course = "Aucune course passée";
					$lieu_last_course = "";
				}
				?>
				 <div class="title-infos">
					<h1 class="title">Historique</h1>
					<p class="text">La précédente course</p>
				</div>
				<div class="infos-course">
					<h1 class="title"> <?php if($date_last_course != "Aucune course passée"){ echo "Course du " . date("d/m/Y", strtotime($date_last_course)); } else { echo $date_last_course; } ?></h1>
					<h3 class="lieu"><?php if($lieu_last_course != "") { echo "Hippodrome de " . $lieu_last_course; } ?></h3>
					<a href="#"><button>voir les résultats</button></a>
				</div>
				<img src="src/img/course-1.jpg" alt="Image de course">
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
