<?php
require_once '../config/connexion/connexion.php';

$prepareRequest = $connexion->prepare('SELECT comments.* , User.pseudo , User.id as idUser FROM comments INNER JOIN User on User.id = comments.user_id WHERE comments.post_id = ? ORDER BY created_at ASC');
$prepareRequest->execute([
    $_POST['post_id']
]);
$data = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);