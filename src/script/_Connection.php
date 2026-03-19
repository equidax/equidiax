<?php

session_start();
include '_script.php';

if(isset($_POST['email'], $_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));

    // Requête de connexion
    $request_subscribe = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = ? AND mdp = ?');
    $request_subscribe->execute([$email, $password]);

    if($user = $request_subscribe->fetch()) {
        // récuperer les données de l'utilisateur
        $_SESSION['id_user'] = $user['Id_Utilisateur'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['mdp'] = $user['mdp'];
        $_SESSION['type_account'] = $user['type_compte'];

        echo "<div style='color: green;'>" . "Utilisateur " . $user['mail'] ." connecté... <a href='../../index.php'>" . "Retour à la page d'accueil!" . "</a>" . "</div>";
    } else {
        echo "<div style='color: red;'>" . "Identifiants incorrects... <a href='../../Connection.php'>" . "Retour à la page de connexion!" . "</a>" . "</div>";
    }
    /*
    while($data =  $request_subscribe->fetch()) {

        // récuperer les données de l'utilisateur
        $_SESSION['id_user'] = $data['Id_Utilisateur'];
        $_SESSION['mail'] = $data['mail'];
        $_SESSION['mdp'] = $data['mdp'];
        $_SESSION['type_account'] = $data['type_compte'];

    }
    */
}

?>
