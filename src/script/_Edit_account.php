<?php 

include '_script.php';

if(isset($_GET['id'])) {

    $id_user = htmlspecialchars($_GET['id']);

    if(isset($_POST['email'], $_POST['type_compte'])) {

        $email = htmlspecialchars($_POST['email']);
        $type_compte = htmlspecialchars($_POST['type_compte']);

        $request = $bdd->prepare('UPDATE utilisateur SET mail = ?, type_compte = ? WHERE Id_Utilisateur = ?');
        $request->execute([$email, $type_compte, $id_user]);

        echo "<div style='color: green;'>" . "Utilisateur " . $email ." modifié... <a href='../../gestion.php'>" . "Retour à la page de gestion!" . "</a>" . "</div>";

    }

}

?>