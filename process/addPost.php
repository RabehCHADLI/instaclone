<?php
session_start();
$uploads = "../imageUpload";
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];
$addpict = move_uploaded_file($tmp_name, $uploads . '/' .$name );
require '../config/connexion/connexion.php';
$prepareRequest = $connexion->prepare('SELECT * FROM User WHERE User.id = ?');
$prepareRequest->execute([
    $_SESSION['id']
]);

$user = $prepareRequest->fetch(PDO::FETCH_ASSOC);

$prepareRequest = $connexion->prepare('INSERT INTO post(user_id, content, photoPost,`like`,create_at) VALUES (?,?,?,?,?)');
$prepareRequest->execute([
    $user['id'],
    $_POST['content'],
    $name ?? null,
    0,
    date("Y-m-d H:i:s")
]);
?>