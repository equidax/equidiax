<?php

	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique</title>
		<link rel="icon" href="src/img/lechevalctrogénial.png" />
		<link rel="stylesheet" href="src/styles/style.css" />
		<link rel="stylesheet" href="src/styles/participer.css" />
	</head>
	<body>
		<!-- Navigation -->
		 <!--
		<nav>
			<img src="src/img/logo blanc.png" alt="Logo du site" class="logo" />
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="courses.php">Course</a></li>
				<?php
				/*session_start();
				if (isset($_SESSION['id_user'])) {
				?>
				<li><a href="profil.php">compte</a></li>
				<?php
				} else {
				?>
				<li><a href="Connection.php">connexion</a></li>
				<?php
				} */
				?>
			</ul>
		</nav>
		-->

		<nav>
			<img src="src/img/logo blanc.png" alt="Logo du site" class="logo" />

			<!-- Bouton burger -->
			<div class="burger" onclick="toggleMenu()">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<ul id="menu">
				<li><a href="index.php">Accueil</a></li>
				<li><a href="courses.php">Course</a></li>
				<?php if (isset($_SESSION['type_account'])) { ?>
					<li><a href="profil.php">compte</a></li>
				<?php } else { ?>
					<li><a href="Connection.php">connexion</a></li>
				<?php } ?>
			</ul>
		</nav>

		<div class="container">

            <div class="infos_course">

                <?php 
                include 'src/script/_script.php';
                    if(isset($_GET['id'])) {
                        $id_course = htmlspecialchars($_GET['id']);
                        $request_course_info = $bdd->prepare('SELECT * FROM course WHERE Id_Course = ?');
                        $request_course_info->execute([$id_course]);

                        while($data_course = $request_course_info->fetch()) {
                            ?>
								<h1 class="title"><?= $data_course['lieu']; ?></h1>
								<p>Date de la course : <?php
								// Formatage de la date pour l'affichage
								$date_course = new DateTime($data_course['date_']);
								echo $date_course->format('d/m/Y \à H:i');
								?>
								<p>Nombre de places restantes : <?= $data_course['place_Restante']; ?></p>
								<?php 
								if(isset($_POST['participer']) && isset($id_course) && isset($_SESSION['id_user'])) {
									// Mise à jour du nombre de places restantes
									$request_update = $bdd->prepare('UPDATE course SET place_Restante = place_Restante - 1 WHERE Id_Course = ?');
									$request_update->execute([$id_course]);

									$request_add_user_course = $bdd->prepare('INSERT INTO participer (Id_Course, id_user) VALUES (?, ?)');
									$request_add_user_course->execute([$id_course, $_SESSION['id_user']]);
									header('Location: participer.php?id=' . $id_course);

								}
								?>
								<form action="" method="post">
									<?php 
									if(isset($_SESSION['id_user'])) {
										// > Vérification si l'utilisateur est déjà inscrit à la course
										$request_check_participation = $bdd->prepare('SELECT * FROM participer WHERE Id_Course = ? AND id_user = ?');
										$request_check_participation->execute([$id_course, $_SESSION['id_user']]);
										if($request_check_participation->rowCount() > 0) {
											?>
											<p>Vous êtes déjà inscrit à cette course.</p>
											<?php
										} else {
											?>
											<?php
											if($_SESSION['type_account'] == 'p') {
											?>
											<button><a style="color: #000; text-decoration: none;" href="jockey.php">Devenir jockey</a></button>
											<?php
											} elseif($_SESSION['type_account'] == 'v') {
											?>
											<button name="participer" type="submit">Participer</button>
											<?php
											} elseif ($_SESSION['type_account'] == "g") {
											?>
											<button><a style="color: #000; text-decoration: none;" href="infos.php?id_course=<?php if(isset($id_course)) { echo $id_course; } ?>">Gérer la course</a></button>
											<?php
											}
										}
									}
								?>
								</form>
							<?php                    
						} 
					}
                ?>

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

		<script>
			function toggleMenu() {
				const menu = document.getElementById("menu");
				menu.classList.toggle("active");
			}
		</script>
	</body>
</html>
