<?php
session_start();
require_once '../config/connexion/connexion.php';
$prepareRequest = $connexion->prepare('SELECT COUNT(*) as nbLike FROM likes WHERE likes.post_id = ?');
$prepareRequest->execute([
    $_POST['post_id']
]);
$like = $prepareRequest->fetch();
echo json_encode($like);

