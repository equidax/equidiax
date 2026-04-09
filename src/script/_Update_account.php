<?php 

// Mise à jour des informations du compte
session_start();
include '_script.php';

if(isset($_SESSION['id_user'])) {
    if(isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['account'])) {
        // Récupérer les données du formulaire
        $email = htmlspecialchars($_POST['email']);
        $mdp = md5(htmlspecialchars($_POST['mdp']));
        if($_POST['account'] == "Gestionnaire") {
            $account = "g";
        } else {
            $account = "u";
        }

        // Requête de mise à jour des informations de l'utilisateur
        $request_update_account = $bdd->prepare('UPDATE utilisateur SET mail = ?, mdp = ?, type_compte = ? WHERE Id_Utilisateur = ?');
        $request_update_account->execute([$email, $mdp, $account, $_SESSION['id_user']]);

        $_SESSION['message'] = "Informations du compte mises à jour avec succès !";
        header('Location: ../../profil.php');
    }
} else {
    header('Location: _Disconnect.php');
}

?>