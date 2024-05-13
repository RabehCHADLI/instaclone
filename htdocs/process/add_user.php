<?php
session_start();
require_once '../config/connexion/connexion.php';
if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $prepareResquest = $connexion->prepare('INSERT INTO `User`(`pseudo`,`password`) VALUES (?,?)');
    $prepareResquest->execute([
        $_POST['pseudo'],
        $password
    ]);
    $lastID = $connexion->lastInsertId();
    $_SESSION['id'] = $lastID;
    $_SESSION['pseudo'] = $_POST['pseudo'];
    header('Location: ../feed.php?success=Inscription Ok');
} else {
    header("Location: ../index.php?error = veuiller remplir le formulaire");
};
