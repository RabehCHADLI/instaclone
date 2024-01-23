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
<div class="container border border-dark rounded-3">
    Bonjour <?= $_SESSION['pseudo']; ?> <br>
    <p class="text-center">VOTRE FIL D'ACTUALITÉ</p>
</div>

<div class="container border border-dark rounded-3">
    <?php
    foreach ($post as $value) { ?>
        <div class="container row">
            <div class="col">

                <!-- AUTEUR DU POST -->
                <h4 class="fw-bold"><?= $value['pseudo'] ?></h4>

                <!-- IMAGE DU POST -->
                 <img src="./imageUpload/<?= $value['photoPost'] ?>" class="w-100" alt=""> 
                <p> <?= $value['create_at'] ?> </p>

                <!-- FORMULAIRE LIKE -->
                <form action="./post.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                    <button type="submit" class="btn"> <i class="fa-regular fa-heart" style="color: #000000;"> NOMBRE DE LIKE DU POST</i> </button>
                </form>
                

                <!-- FORMULAIRE COMMENTAIRE -->
                <form action="./post.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                    <button type="submit" class="btn"> <i class="fa-regular fa-comment" style="color: #000000;"> NOMBRE DE COMMENTAIRES DU POST </i></button>
                </form>
         
            </div>
            <div class="col">
                <p class="text-danger"> <?= $value['content'] ?> </p>
                <form action="./process/add_comment.php" method="post">
                    <input class="w-100" type="text" name="content" id="content">
                    <input type="hidden" name="id" value="<?= $value['id'] ?>">
                    <button type="submit" class="btn btn-outline-dark"> Commenter </button>
                </form>
            </div>
        </div>
    <?php  } ?>
</div>


<?php
include './partials/footer.php';
?>