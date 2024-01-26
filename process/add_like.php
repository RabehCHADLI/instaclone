<?php
session_start();
require_once '../config/connexion/connexion.php';
$prepareRequest = $connexion->prepare('SELECT * FROM likes WHERE likes.user_id = ? AND likes.post_id = ?');
$prepareRequest->execute([
    $_SESSION['id'],
    $_POST['post_id']
]);
$userLike = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);


if(!empty($userLike)){
    $prepareRequest = $connexion->prepare('DELETE FROM likes WHERE likes.user_id = ? AND likes.post_id = ?');
    $prepareRequest->execute([
        $_SESSION['id'],
        $_POST['post_id']
    ]);

}else{
    $prepareRequest = $connexion->prepare('INSERT INTO likes(user_id, post_id, created_at) VALUES (?, ? , ?)');
    $prepareRequest->execute([
        $_SESSION['id'],
        $_POST['post_id'],
        date("Y-m-d H:i:s")
    ]);
}