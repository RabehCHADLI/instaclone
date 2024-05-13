<?php
session_start();
require_once '../config/connexion/connexion.php';
if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $preparedRequest = $connexion->prepare('SELECT * FROM `User` WHERE pseudo = ?');
    $preparedRequest->execute([
        $_POST['pseudo']
    ]);
    $user = $preparedRequest->fetch(PDO::FETCH_ASSOC);
    if (!empty($user)) {
        $passwordVerif = password_verify($_POST['password'], $user['password']);
        if ($passwordVerif) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            header('Location: ../feed.php?success= Connexion Réeussite');
        }else{
            header('Location: ../index.php?error=Mot de passe incorrect');
        }
    }else{
        header('Location: ../index.php?error=Aucun Pseudo a se nom');
    }

}else{
    header('Location: ../index.php?error=veuillez remplir le formulaire SVP');
}











?>