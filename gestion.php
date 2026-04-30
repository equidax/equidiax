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
        <link rel="stylesheet" href="src/styles/gestion.css" />
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

        
        <h1 class="title">Gestion des comptes</h1>
        <?php
        // Vérifier que l'utilisateur est un gestionnaire de course
        if(isset($_SESSION['id_user'], $_SESSION['type_account']) && $_SESSION['type_account'] == "g") {

            // Récuperer les utilisateurs
            $request = $bdd->query("SELECT * FROM utilisateur");
            while($data = $request->fetch()) {
                $id_user = $data['Id_Utilisateur'];
                $mail = $data['mail'];
                $type_compte = $data['type_compte'];
        ?>
        <!--Afficher les utilisateurs dans un tableau -->
        <div class="container">
            <table>
                <tbody>
                    <tr>
                        <td><?= $mail ?></td>
                        <td><?php if($type_compte == 'p') { echo 'Propriétaire'; } elseif($type_compte == 'v') { echo 'Visiteur'; } else { echo 'Gestionnaire'; } ?></td>
                        <td><button><a style="text-decoration: none; color: #000;" href="src/script/_Delete_account.php?id=<?= $id_user ?>">Supprimer</a></button></td>
                        <td><button><a style="text-decoration: none; color: #000;" href="Modif_account.php?id=<?= $id_user ?>">Modifier</a></button></td>
                    </tr>
                </tbody>
            </table>
        <?php
            }

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
