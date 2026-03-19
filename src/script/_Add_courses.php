<?php

include '_script.php';

if(isset($_POST['date_course'], $_POST['place'], $_POST['nbr_places'])) {
    
    $date_course = $_POST['date_course'];
    $place = $_POST['place'];
    $nbr_places = $_POST['nbr_places'];

    // Préparer la requête d'insertion
    $request_add_courses = $bdd->prepare("INSERT INTO course (date_, lieu, nbr_Max_Place, place_Restante) VALUES (?, ?, ?, ?)");
    $request_add_courses->execute([$date_course, $place, $nbr_places, $nbr_places]);

    // Message de succès
    echo "Ajout de la course réussie !";

} else {
    header('Location: _Disconnect.php');
}

?>