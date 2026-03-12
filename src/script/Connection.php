<?php

session_start();
include 'script.php';

if(isset($_POST['email'], $_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));

    // Requête d'inscription
    $request_subscribe = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = ? AND mdp = ?');
    $request_subscribe->execute([$email, $password]);

    while($data =  $request_subscribe->fetch()) {

        // récuperer les données de l'utilisateur
        $_SESSION['id_user'] = $data['Id_Utilisateur'];
        $_SESSION['mail'] = $data['mail'];
        $_SESSION['mdp'] = $data['mdp'];
        $_SESSION['type_account'] = $data['type_compte'];

    }

    echo "<div class='message'>" . "Utilisateur " . $_SESSION['mail'] ." connecté... <a href='../../index.html'>" . "Retour à la page d'accueil!" . "</a>" . "</div>";
}

?>
