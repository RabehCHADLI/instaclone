<?php
session_start();
require '../config/connexion/connexion.php';
$prepareRequest = $connexion->prepare('SELECT * FROM `User` WHERE User.id = ?');
$prepareRequest->execute([
    $_SESSION['id']
]);
$user = $prepareRequest->fetch(PDO::FETCH_ASSOC);
$uploads = "../imageUpload";
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];
$addpict = move_uploaded_file($tmp_name, $uploads . '/' .$name );















$prepareRequest = $connexion->prepare('INSERT INTO `post`(`user_id`, `content`, `photoPost`,`like`,`create_at`) VALUES (?,?,?)');
$prepareRequest->execute([
    $user['id'],
    $_POST['content'],
    $name ?? null

]);









?>