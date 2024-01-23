<?php
session_start();

if (!empty($_SESSION['pseudo'])
    && !empty($_POST['content'])) {

        // Connexion BDD
        require_once '../config/connexion/connexion.php';
        
        // Récuperer l'utilisateur
        $preparedRequestGetUser = $connexion->prepare(
            "SELECT * FROM User WHERE pseudo = ?"
        );
        $preparedRequestGetUser->execute([
            $_SESSION["pseudo"]
        ]);
        $user = $preparedRequestGetUser->fetch(PDO::FETCH_ASSOC);

        // Préparer la requête d'insertion dans la table message
        $preparedRequestCreateComment = $connexion->prepare(
            "INSERT INTO comments (user_id , content , post_id, created_at )VALUES(?,?,?,?)"
        );
        // Execute la requete pour inserer le message 
        $preparedRequestCreateComment->execute([
            $_SESSION['id'],
            $_POST['content'],
            $_POST['id'],
           date("Y-m-d H:i:s")
        ]);

        header('Location: ../feed.php?success=Le commentaire a bien été enregistré');
}else{
    header('Location: ../feed.php?error=Problème lors de l\'enregistrement du commentaire');
}
