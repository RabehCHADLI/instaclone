<?php
session_start();
date_default_timezone_set('Europe/Paris');
include './partials/header.php';
include './partials/navbar.php';
require_once './config/connexion/connexion.php';

//AFFICHER LES PHOTOS
$prepareRequest = $connexion->prepare('SELECT post.*, User.id AS User_ID, User.pseudo, User.photo_profil FROM post INNER JOIN User ON User.id = post.user_id ORDER BY post.create_at DESC');
$prepareRequest->execute();
$post = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);


//AFFICHER LES COMMENTAIRES
$prepareRequest = $connexion->prepare('SELECT * FROM `comments` ORDER BY `comments`.`created_at` DESC ');
$prepareRequest->execute();
$comment = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);



?>
<div class="feed container border border-secondary rounded-3">
   
    <?php
    foreach ($post as $value) {

        //AFFICHER LE NOMBRE DE LIKES
        $prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM likes WHERE likes.post_id = ?');
        $prepareRequest->execute([
            $value['id']
        ]);
        $like = $prepareRequest->fetch();

        //AFFICHER LE NOMBRE DE COMMENTAIRES
        $prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM comments WHERE comments.post_id = ?');
        $prepareRequest->execute([
            $value['id']
        ]);
        $nbcomment = $prepareRequest->fetch(); ?>

        
        
        <div class="card border border-danger" style="width: 30rem;"> 
            <!-- AUTEUR DU POST -->
            <form action="./profil_other.php" method="post">
                <h5 class="card-title">
                    <button class="btn" type="submit">
                        <img src="./imageUpload/<?= $value['photo_profil'] ?>" class="picc2 m-2 border rounded-circle m-3" style="clip-path:ellipse(50% 30%); clip-path:ellipse(50% 50%); height:100px;">
                    </button>
                    <span class="fw-bold fs-4 text-uppercase"><?= $value['pseudo'] ?></span>
                    <input type="hidden" name="user_id" value="<?= $value['user_id'] ?>">
                    <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                    <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
                </h5>
            </form>
            <!-- VOIR LE POST -->
            <form action="./post.php" method="post">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
                <button class="btn" type="submit">
                    <img src="./imageUpload/<?= $value['photoPost'] ?>" style="width: 25rem;" alt="photo du post">
                </button>

                <div class="card-body">
                    <!-- LIKE -->
                    <form action="./process/add_like.php" method="post">
                        <h5 class="card-title">
                            <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                            <button type="submit" class="btn"> <i class="fa-regular fa-heart" style="color: #000000;"> <?= $like['0'] ?> </i> </button>
                        </h5>
                    </form>

                    <!-- COMMENT -->
                    <form action="./post.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                        <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
                        <button type="submit" class="btn"> <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment['0'] ?> </i> </button>
                    </form>
                    <p class="card-text"><?= $value['content'] ?></p>

                </div>
        </div>
    <?php
    } ?>


    <?php
    include './partials/footer.php';
    ?>