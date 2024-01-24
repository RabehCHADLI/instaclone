<?php
session_start();
date_default_timezone_set('Europe/Paris');
include './partials/header.php';
include './partials/navbar.php';
require_once './config/connexion/connexion.php';

//AFFICHER LES PHOTOS
$prepareRequest = $connexion->prepare('SELECT post.*, User.id AS User_ID, User.pseudo FROM post INNER JOIN User ON User.id = post.user_id ORDER BY post.create_at');
$prepareRequest->execute();
$post = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);


//AFFICHER LES COMMENTAIRES
$prepareRequest = $connexion->prepare('SELECT * FROM `comments` ORDER BY `comments`.`created_at` DESC ');
$prepareRequest->execute();
$comment = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);



?>
<div class="container entete border border-dark rounded-3">
    Bonjour <?= $_SESSION['pseudo']; ?> <br>
    <p class="text-center">VOTRE FIL D'ACTUALITÉ</p>
</div>

<div class="container border border-dark rounded-3">
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
        

        <div class="container row">
            <div class="col">

            </div>
            <div class="col-9">

                <!-- AUTEUR DU POST -->
                <h4 class="fw-bold"><?= $value['pseudo'] ?></h4>

                <!-- FORMULAIRE VOIR LE POST-->
                <!-- IMAGE DU POST -->
                <form action="./post.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                    <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
                    <button class="btn " type="submit"> <img src="./imageUpload/<?= $value['photoPost'] ?>" class="box w-100" alt=""> </button>
                    <p> <?= $value['create_at'] ?> </p>
                </form>

                <!-- AFFICHER LA CAPTION -->
                <p class="text-danger"> <?= $value['content'] ?> </p>
            

                <!-- FORMULAIRE LIKE -->
                <form action="./process/add_like.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                    <button type="submit" class="btn"> <?= $like['0'] ?> <i class="fa-regular fa-heart" style="color: #000000;"> </i> </button>
                </form>

                <!-- FORMULAIRE COMMENTAIRE -->
                <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment ['0'] ?> </i>
</div>

            <div class="col">

                <!-- AFFICHER LES COMMENTAIRES
                <div id="scroll" class="border rounded-3 border-dark border-2 p-1 row">
                <?php  ?>
                </div>
                 FORMULAIRE COMMENTAIRE -->
                <!-- <form action="./process/add_comment.php" method="post">
                    <input class="w-100" type="text" name="content" id="content">
                    <input type="hidden" name="id" value="<?= $value['id'] ?>">
                    <button type="submit" class="btn btn-outline-dark"> Commenter </button>
                </form> -->
                <!-- </div> -->
            </div>
        <?php  } ?>
        </div>


        <?php
        include './partials/footer.php';
        ?>