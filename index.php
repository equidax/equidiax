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

			<div class="card-1">
				<!-- Prochaine course -->
				<img src="src/img/course-1.jpg" alt="Image de course">
				<div class="infos-course">
					<h1 class="title">Course du 13 mai 2026</h1>
					<h3 class="lieu">Hippodrome de Cholet</h3>
					<h3 class="nbr_participants">24 participants</h3>
					<a href="#"><button>s'inscire</button></a>
				</div>
				<div class="title-infos">
					<h1 class="title">Actualités</h1>
					<p class="text">Les prochaines courses</p>
				</div>
			</div>

			<div class="card-2">
				<!-- Dernière course enregistrée -->
				 <div class="title-infos">
					<h1 class="title">Historique</h1>
					<p class="text">Les anciennes courses</p>
				</div>
				<div class="infos-course">
					<h1 class="title">Course du 12 mars 2026</h1>
					<h3 class="lieu">Hippodrome de Cholet</h3>
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
