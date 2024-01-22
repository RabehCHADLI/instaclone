<?php
session_start();

if (!empty($_POST['pseudo'])) {

    // // Connexion BDD
    require_once '../config/connexion/connexion.php';

    // Vérifier si le user existe
    // Préparer la requête 
    $preparedRequestUser = $connexion->prepare(
        "SELECT * FROM User WHERE pseudo = ?"
    );
    $preparedRequestUser->execute([
        $_POST['pseudo']
    ]);
    $user = $preparedRequestUser->fetch(PDO::FETCH_ASSOC);


    if (empty($user)) {

        // Créer un user
        // Préparer la requête d'insertion dans la table user
        $preparedRequestCreateUser = $connexion->prepare(
            "INSERT INTO User (pseudo) VALUES(?)"
        );


        // Exécute la requete pour insérer le pseudo
        $preparedRequestCreateUser->execute([
            $_POST['pseudo'],
        ]);

        // Connecte l'utilisateur
        $_SESSION['id'] = $connexion->lastInsertId();
        $_SESSION['pseudo'] = $_POST["pseudo"];


<<<<<<< HEAD
        header('Location: ../index.php?success=Le pseudo a bien été créé');
=======
        header('Location: ../feed.php?success=Le pseudo a bien été créé');
>>>>>>> 545cbd0 (Orlane)
        die;
    } else {

        //Connecte l'utilisateur
        $_SESSION['id'] = $user['id'];
        $_SESSION['pseudo'] = $user["pseudo"];
    }

    if (!empty($user['pseudo'])) {

        $_SESSION['pseudo'] = $user['pseudo'];

<<<<<<< HEAD
        header('Location: ../index.php');
    }
} else {
    header('Location: ../config/connexion/connexion.php?error=Problème lors de la création du pseudo');
}
=======
        header('Location: ../feed.php');
    }
} else {
    header('Location: ../index.php?error=Problème lors de la création du pseudo');
}
>>>>>>> 545cbd0 (Orlane)
