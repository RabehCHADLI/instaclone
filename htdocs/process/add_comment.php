<?php
session_start();

if (!empty($_POST['content']
&& !empty ($_POST['post_id']))){

    // Connexion BDD
    require_once '../config/connexion/connexion.php';

    // Récuperer l'utilisateur
    $preparedRequestGetUser = $connexion->prepare(
            "SELECT * FROM User WHERE pseudo = ?"
        );
        $preparedRequestGetUser->execute([
            $_SESSION['pseudo']
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
            $_POST['post_id'],
            date("Y-m-d H:i:s")
        ]);
        
        $message_send_comment_succes = "Votre commentaire a bien été posté";
        echo json_encode($message_send_comment_success);
    }
else {
    $message_send_comment_fail = "Echec lors de l'envoi de votre commentaire";
    echo json_encode($message_send_comment_fail);
}