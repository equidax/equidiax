<?php
	session_start();
	require 'src/script/_script.php';

    if(isset($_SESSION['type_account'])) {

        if(isset($_POST['nom'], $_POST['race'])) {
            $nom = htmlspecialchars($_POST['nom']);
            $race = htmlspecialchars($_POST['race']);

            $add_jockey = $bdd->prepare("INSERT INTO cheval (nom, race, Id_Propriétaire) VALUES (?, ?, ?)");
            $add_jockey->execute([$nom, $race, $_SESSION['id_user']]);

            $_SESSION['message'] = "Cheval ajouté avec succès !";
        }

    } else {
        header('Location: src/script/_Disconnect.php');
    }

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique</title>
		<link rel="icon" href="src/img/lechevalctrogénial.png" />
		<link rel="stylesheet" href="src/styles/style.css" />
		<link rel="stylesheet" href="src/styles/profil.css" />
		<link rel="stylesheet" href="src/styles/jockey.css" />
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

        <div class="container">
            <h1 class="title">Formulaire Inscription Jockey</h1>

            <?php
            if(isset($_SESSION['message'])) {
                ?>
                <div class="update_success">
                    <?= $_SESSION['message']; ?>
                </div>
                <?php
                unset($_SESSION['message']);
            }
            ?>
            <form action="" method="post">
                <div class="input-nom">
                    <label for="nom">Nom du cheval : </label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="input-race">
                    <label for="race">Race du cheval : </label>
                    <input type="text" id="race" name="race" required>
                </div>
                <div class="btn">
                    <button type="submit">Enregistrer</button>
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
