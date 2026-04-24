<?php

    if(isset($_GET['id'], $_SESSION['type_account']) && $_SESSION['type_account'] == 'g') {
        include '_script.php';
        $id_user = htmlspecialchars($_GET['id']);
        $request_delete_account = $bdd->prepare("DELETE FROM utilisateur WHERE Id_Utilisateur = ?");
        $request_delete_account->execute([$id_user]);
        header('Location: _Disconnect.php');
    } else {
        header('Location: _Disconnect.php');
    }

?>