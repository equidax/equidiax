<?php 

include 'src/script/_script.php';
session_start();

if($_SESSION['type_account'] != "g") {
    header('Location: src/script/_Disconnect.php');
}

if(isset($_GET['id'])) {

    $id_user = htmlspecialchars($_GET['id']);

    //$request = $bdd->prepare('UPDATE utilisateur SET mail = ?, mdp = ? WHERE Id_Utilisateur = ?');
    //$request->execute([$_POST['email'], md5($_POST['mdp']), $id_user]);

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EQUIDIAX | Site de courses hippique Modification d'utilisateur</title>
		<link rel="icon" href="src/img/lechevalctrogénial.png" />
		<link rel="stylesheet" href="src/styles/style.css" />
		<link rel="stylesheet" href="src/styles/courses.css" />
        <link rel="stylesheet" href="src/styles/edit_account.css" />
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
        

        <div class="container-edit">
            <!-- Formulaire de modification d'utilisateur -->
             <?php
            if(isset($_GET['id'])) {

                $id_user = htmlspecialchars($_GET['id']);

                $request = $bdd->prepare('SELECT * FROM utilisateur WHERE Id_Utilisateur = ?');
                $request->execute([$id_user]);
                $data = $request->fetch();
            }
            ?>
            <h1 class="title">Modifier l'utilisateur <?php if(isset($data['mail'])) { echo $data['mail']; } ?></h1>
            <form method="post" action="src/script/_Edit_account.php?id=<?= $id_user ?>">
                <div class="input-email">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?php if(isset($data['mail'])) { echo $data['mail']; } ?>">
                </div>

                <div class="input-mdp">
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" disabled>
                </div>

                <div class="input-type_compte">
                    <label for="type_compte">Type de compte :</label>
                    <input type="text" id="type_compte" name="type_compte" value="<?php if(isset($data['type_compte'])) { echo $data['type_compte']; } ?>">
                </div>

                <button type="submit">Modifier</button>
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