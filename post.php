<?php
include './partials/header.php';
include './partials/navbar.php';

$prepareRequest = $connexion->prepare(
    'SELECT * FROM `post` INNER JOIN likes ON post.id = likes.post_id WHERE post.id = ?' 
);

$prepareRequest->execute([
    $_POST['id']
]);

$post = $prepareRequest->fetch(PDO::FETCH_ASSOC);


?>

PROCESS AFFICHER LE POST + SES COMMENTAIRES + SES LIKES