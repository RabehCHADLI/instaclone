<?php
session_start();
$uploads = "../imageUpload";
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];
$addpict = move_uploaded_file($tmp_name, $uploads . '/' .$name );
require '../config/connexion/connexion.php';


$prepareRequest = $connexion->prepare(
    'UPDATE User SET photo_profil= ? WHERE id=?'
);
$prepareRequest->execute([
   $name,
   $_SESSION['id']
]);

header('Location: ../profil.php?success=Votre photo de profil a été ajoutée')
?>