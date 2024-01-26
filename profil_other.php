<?php
session_start();
include './partials/header.php';
include './partials/navbar.php';
require_once './config/connexion/connexion.php';


//AFFICHER LES POSTS
$prepareRequest = $connexion->prepare(
    'SELECT * FROM `post` WHERE user_id = ? ORDER BY create_at DESC'
);
$prepareRequest->execute([
    $_POST['user_id']
]);
$post_other = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);
$prepareRequest = $connexion->prepare(
    'SELECT * FROM `User` WHERE id = ? '
);
$prepareRequest->execute([
    $_POST['user_id']
]);

$user = $prepareRequest->fetch(PDO::FETCH_ASSOC);
?>


<div class="profil container border border-secondary rounded-3 p-5">
    <div class="container row ">
        <div class=" m-3 h-100">
            <img src="./imageUpload/<?= $user['photo_profil']; ?>" class="border rounded-circle m-3" style="clip-path:ellipse(50% 30%); height:200px;">
            <span class="fw-bold  fs-3 text-uppercase"> <?= $_POST['pseudo']; ?> </span>
        </div>
        
    </div>
<div class="container image-grid border border-dark rounded-3 p-5">

    <?php foreach ($post_other as $post_other) {

        $prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM comments WHERE comments.post_id = ?');
        $prepareRequest->execute([
            $post_other['id']
        ]);
        $nbcomment = $prepareRequest->fetch();

        $prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM likes WHERE likes.post_id = ?');
        $prepareRequest->execute([
            $post_other['id']
        ]);
        $like = $prepareRequest->fetch();

    ?>

        <div class="col-m-12">

        <!-- FORMULAIRE POUR ALLER VOIR LE POST EN CLIQUANT SUR LA PHOTO -->
        <form action="./post.php" method="post">
            <input type="hidden" name="post_id" value="<?= $post_other['id'] ?>">
            <input type="hidden" name="pseudo" value="<?= $_SESSION['pseudo'] ?>">
            <button class="btn" type="submit">
                <img src="./imageUpload/<?= $post_other['photoPost'] ?>" class="w-100" alt="">
            </button>
        </form>
        </div>
    <?php } ?>
</div>

    <?php
    include './partials/footer.php';
    ?>