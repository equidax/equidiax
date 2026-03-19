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
            <h1 class="maintitle">Courses disponible</h1>
            <?php
            $courses = 0; // Remplacez cette ligne par votre logique pour récupérer les courses disponibles
            while($courses != 5) {
                ?>
                <div class="content">
                    <div class="courses">
                        <div class="date">Dans 2jrs</div>
                        <div class="title">
                            <h2>Cours du 13 mai 2026</h2>
                            <p class="lieu">Hippodrome de Cholet</p>
                        </div>
                        <div class="inscription">
                            <?php
                            
                            if(isset($_SESSION['type_account'])) {
                                if($_SESSION['type_account'] == "g") {
                                    ?>
                                    <a href="#"><button>informations</button></a>
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
                            <p class="nbr_participants"><span>5</span> places restantes</p>
                        </div>
                    </div>
                </div>
                <?php
                $courses += 1; // Remplacez cette ligne par votre logique pour arrêter la boucle après avoir affiché les courses disponibles
            }
            ?>


		</div>

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
²