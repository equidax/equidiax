<?php

if(isset($_POST['check_course'])) {
    $id_course = $_POST['check_course'];
    echo $id_course;
}
    // Effectuez ici la logique pour supprimer la course correspondante de votre base de données en utilisant l'ID de la course
    // Par exemple, vous pouvez utiliser une requête SQL pour supprimer la course de votre table