<?php
session_start();
$uploads = "../imageUpload";
$tmp_name = $_FILES['image']['tmp_name'];
$name =     $_FILES['image']['name']; 
$addpict = move_uploaded_file($tmp_name, $uploads . '/' .$name );
require '../config/connexion/connexion.php';
$prepareRequest = $connexion->prepare('SELECT * FROM User WHERE User.id = ?');
$prepareRequest->execute([
    $_SESSION['id']
]);

$user = $prepareRequest->fetch(PDO::FETCH_ASSOC);

if(!empty ($name)){

    
    $prepareRequest = $connexion->prepare(
        'INSERT INTO post(user_id, content, photoPost, create_at) VALUES (?,?,?,?)'
    );
    $prepareRequest->execute([
        $user['id'],
        $_POST['content'],
        $name ?? null,
        date("Y-m-d H:i:s")
    ]);
    
    
    header('Location: ../feed.php?success=Votre post a été ajouté');
}
else {
    header('Location: ../feed.php?success=Votre post n\'a pas été ajouté');
}
?>