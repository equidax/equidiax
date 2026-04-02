<?php
require '_script.php';
session_start();

if(isset($_POST['check_course']) || isset($_GET['id_course'])) {
    $id_course = isset($_POST['check_course']) ? htmlspecialchars($_POST['check_course']) : htmlspecialchars($_GET['id_course']);
    // echo $id_course;

    // Requête de suppression de la course
    $request_delete_course = $bdd->prepare('DELETE FROM course WHERE id_course = ?');
    $request_delete_course->execute([$id_course]);

    echo "<div style='color: red;' class='message'>" . "Course supprimée... <a href='../../courses.php'>" . "Retour à la page des courses!" . "</a>" . "</div>";

}    // Effectuez ici la logique pour supprimer la course correspondante de votre base de données en utilisant l'ID de la course
    // Par exemple, vous pouvez utiliser une requête SQL pour supprimer la course de votre table