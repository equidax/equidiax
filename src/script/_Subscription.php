<?php

session_start();
include '_script.php';

if(isset($_POST['email'], $_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));

    // Requête d'inscription
    $request_subscribe = $bdd->prepare('INSERT INTO utilisateur (mail, mdp) VALUES(?, ?)');
    $request_subscribe->execute([$email, $password]);

    #$request_add_profil = $bdd->prepare('INSERT INTO propriétaire (Id_Propriétaire) VALUES(?)');
    #$request_add_profil->execute([$bdd->lastInsertId()]);

    echo "<div class='message'>" . "Utilisateur créé... <a href='../../index.php'>" . "Retour à la page d'accueil!" . "</a>" . "</div>";
}

?>
