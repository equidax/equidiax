<?php
	session_start();
	require 'src/script/_script.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique</title>
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
				<li><a href="src/script/_Disconnect.php">déconnexion</a></li>
			</ul>
		</nav>

		<?php
		if(isset($_SESSION['id_user'], $_SESSION['type_account'])) {
			if($_SESSION['type_account'] == "g") {
				if(isset($_SESSION['message'])) {
					?>
					<div class="update_success">
						<?= $_SESSION['message']; ?>
					</div>
					<?php
					unset($_SESSION['message']);
				}
				// Logique pour les gestionnaires de course
				?>
				<div class="container">

					<h1 class="title">Profil Gestionnaire</h1>
					<h3 class="title">Ajouter une course</h3>
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

					<!-- Formulaire d'information de compte -->
					<?php
					// Récupérer les informations de l'utilisateur connecté
					if(isset($_SESSION['id_user'])) {

						$request_info_account = $bdd->prepare('SELECT * FROM utilisateur WHERE Id_Utilisateur = ?');
						$request_info_account->execute([$_SESSION['id_user']]);

						while($data = $request_info_account->fetch()) {
							// Infos user
							$user_id = $data['Id_Utilisateur'];
							$mail = $data['mail'];
							$mdp = $data['mdp'];
							$account = $data['type_compte'];

					}
					?>
					<div class="infos_account">
						<h3 class="title">Informations du compte</h3>
						<form action="src/script/_Update_account.php" method="post">
							<div class="mail">
								<label for="email">Adresse mail: </label>
								<input type="text" id="email" name="email" value="<?= $mail; ?>">
							</div>
							<div class="mdp">
								<label for="mdp">Mot de passe: </label>
								<input type="password" id="mdp" name="mdp">
							</div>
							<div>
								<label for="account">Type de compte: </label>
								<?php 
								// Afficher le type de compte
								if($account == "g") {
								?>
								<input type="text" name="account" id="account" value="Gestionnaire">	
								<?php
								}
								?>
							</div>
							<div class="btn">
								<button type="submit">Mettre à jour</button>
							</div>
						</form>
					</div>
					<?php 
						}
					?>
				</div>
				<?php
			}
		?>
		<?php
		} else {
			header('Location: src/script/_Disconnect.php');
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
