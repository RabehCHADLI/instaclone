<?php
include './partials/header.php';
include './partials/navbar.php';
require_once './config/connexion/connexion.php';
// AFFICHER LE POST + SES LIKES
$prepareRequest = $connexion->prepare(
    'SELECT * FROM `post` INNER JOIN likes ON post.id = likes.post_id WHERE post.id = ?'
);

$prepareRequest->execute([
    $_POST['post_id']
]);

$post = $prepareRequest->fetch(PDO::FETCH_ASSOC);
?>
<div class="container border border-dark rounded-3">
    <div class="container row">
        <div class="col">

            <!-- AUTEUR DU POST -->
            <h4 class="fw-bold"> PSEUDO </h4>

            <!-- IMAGE DU POST -->
            <img src="./imageUpload/<?= $post['photoPost'] ?>" class="w-50" alt="">
            <p> <?= $post['create_at'] ?> </p>

            <!-- FORMULAIRE LIKE -->
            <i class="fa-regular fa-heart" style="color: #000000;"> Nombre de likes</i>
            <form action="./post.php" method="post">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <button type="submit" class="btn"> </button>
            </form>

            <!-- FORMULAIRE COMMENTAIRE -->
            <i class="fa-regular fa-comment" style="color: #000000;"> Nombre de commentaires</i>
            <input class="w-100" type="text" name="content" id="content">
            <input type="hidden" name="id" value="<?= $value['id'] ?>">
        </div>

            <div class="col">
            <button type="submit" class="btn btn-outline-dark"> COMMENTER </button>
        </div>
    </div>

</div>

<?php
include './partials/footer.php';
?>