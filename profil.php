<?php
session_start();
// include './config/connexion/debug.php';
include './partials/header.php';
include './partials/navbar.php';

// Connexion BDD
require_once '../htdocs/config/connexion/connexion.php';
$preparedRequestProfil = $connexion->prepare(
    "SELECT * FROM User WHERE id = ?"
);
$preparedRequestProfil->execute([
    $_SESSION['id']
]);
$profil = $preparedRequestProfil->fetch(PDO::FETCH_ASSOC);
$preparedRequestPost = $connexion->prepare('SELECT * FROM `post` WHERE user_id = ?');
$preparedRequestPost->execute([
    $_SESSION['id']
]);
$post = $preparedRequestPost->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="profil container border border-secondary rounded-3 p-5">
    <img src="./imageUpload/<?= $profil['photo_profil']?>" class="border rounded-circle m-3">
    <span class="fw-bold fs-3 text-uppercase"> <?= $_SESSION['pseudo']; ?> </span>

    <div class="container border border-secondary rounded-3  d-flex justify-content-center ">
        <div class=" m-3 " style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title">Choose a profile picture</h5>
                
                <form action="./process/add_profile_photo.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3 mx-auto d-block">
                        <label for="file" class="form-label"></label>
                        <input type="file" name='image' id="image">
                    </div>
                    <button class="btn btn-outline-dark mx-auto d-block mt-5 mb-3">Choose</button>
                </form>
            </div>
        </div>
        <?php
        foreach ($post as $value) {

            $prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM comments WHERE comments.post_id = ?');
            $prepareRequest->execute([
                $value['id']
            ]);
            $nbcomment = $prepareRequest->fetch();
            $prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM likes WHERE likes.post_id = ?');
            $prepareRequest->execute([
                $value['id']
            ]);
            $like = $prepareRequest->fetch();

        ?>
            <img src="./imageUpload/<?= $value['photoPost'] ?>" class="w-100" alt="">
            <p><?= $value['create_at'] ?></p>
            <p><?= $value['content'] ?></p>
            <form action="./process/add_like.php" method="post">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <button type="submit" class="btn"> <i class="fa-regular fa-heart" style="color: #000000;"> <?= $like['0'] ?> </i> </button>
            </form>

            <form action="./post.php" method="post">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <input type="hidden" name="pseudo" value="<?= $_SESSION['pseudo'] ?>">
                <button type="submit" class="btn"> <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment['0'] ?> </i> </button>
            </form>
        <?php } ?>
    </div>

    <?php
    include './partials/footer.php';
    ?>