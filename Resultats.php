<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique</title>
		<link rel="icon" href="src/img/lechevalctrogénial.png" />
		<link rel="stylesheet" href="src/styles/style.css" />
		<link rel="stylesheet" href="src/styles/resultats.css" />
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

		<!-- Contenu de la page -->
		<div class="container">
			<?php
			if(isset($_SESSION['type_account']) && $_SESSION['type_account'] == 'g') {
				if(isset($_GET['id'])) {
					include 'src/script/_script.php';
					$id_course = htmlspecialchars($_GET['id']);
					$request_course = $bdd->prepare("SELECT * FROM course WHERE Id_Course = ?");
					$request_course->execute([$id_course]);
					$data_course = $request_course->fetch();

					if ($data_course) {
						$date_course = $data_course['date_'];
						$lieu_course = $data_course['lieu'];
						$nbr_places_restantes = $data_course['place_Restante'];
						$nbr_places_max = $data_course['nbr_Max_Place'];
						$nbr_places_prises = $nbr_places_max - $nbr_places_restantes;
			?>
		</div>
		<div class="card-1">
			<!-- Prochaine course -->
			<div class="infos-course">
				<h1 class="title">Course du <?php echo date("d/m/Y", strtotime($date_course)); ?></h1>
				<h3 class="message">Résultats non attribués</h3>
				<button>Ajouter les résultats</button>
		</div>
		<?php
					}
				}
			} elseif(isset($_SESSION['type_account']) && $_SESSION['type_account'] == 'p') {
				if(isset($_GET['id'])) {
					include 'src/script/_script.php';
					$id_course = htmlspecialchars($_GET['id']);
					$request_course = $bdd->prepare("SELECT * FROM course WHERE Id_Course = ?");
					$request_course->execute([$id_course]);
					$data_course = $request_course->fetch();

					if ($data_course) {
						$date_course = $data_course['date_'];
						$lieu_course = $data_course['lieu'];
						$nbr_places_restantes = $data_course['place_Restante'];
						$nbr_places_max = $data_course['nbr_Max_Place'];
						$nbr_places_prises = $nbr_places_max - $nbr_places_restantes;
			?>
			<div class="card-1">
			<!-- Prochaine course -->
			<div class="infos-course">
				<h1 class="title">Course du <?php echo date("d/m/Y", strtotime($date_course)); ?></h1>
				<h3 class="message">Résultats non attribués</h3>
		</div>
			<?php
					}
				}
			} elseif(isset($_SESSION['type_account']) && $_SESSION['type_account'] == 'v') {
				// Afficher les résultats de la course pour les visiteurs
				if(isset($_GET['id'])) {
					include 'src/script/_script.php';
					$id_course = htmlspecialchars($_GET['id']);
					$request_course = $bdd->prepare("SELECT * FROM course WHERE Id_Course = ?");
					$request_course->execute([$id_course]);
					$data_course = $request_course->fetch();

					if ($data_course) {
						$date_course = $data_course['date_'];
						$lieu_course = $data_course['lieu'];
						$nbr_places_restantes = $data_course['place_Restante'];
						$nbr_places_max = $data_course['nbr_Max_Place'];
						$nbr_places_prises = $nbr_places_max - $nbr_places_restantes;
				?>
				<div class="card-1">
					<!-- Prochaine course -->
					<div class="infos-course">
						<h1 class="title">Course du <?php echo date("d/m/Y", strtotime($date_course)); ?></h1>
						<h3 class="message">Résultats non attribués</h3>
						<button>Ajouter les résultats</button>
				</div>
				<?php
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
