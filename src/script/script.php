<?php

// Connexion à la base de données
try {

    $bdd = new PDO('mysql:host=localhost;dbname=equidiax;charset=utf8', 'root', '');

} catch(Exception $error) {

    die('Erreur : '.$error->getMessage());

}


?>
