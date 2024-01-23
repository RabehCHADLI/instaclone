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

// AFFICHER LES COMMENTAIRES
$prepareRequest = $connexion->prepare(
    'SELECT comments.* , User.pseudo , User.id as idUser FROM comments INNER JOIN User on User.id = comments.user_id WHERE comments.post_id = ? ORDER BY created_at DESC;'
);
$prepareRequest->execute([
    $_POST['post_id']
]);
$comment = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container border border-dark rounded-3">
    <div class="container row">
        <div class="col">

            <!-- AUTEUR DU POST -->
            <h4 class="fw-bold"> PSEUDO </h4>

            <!-- IMAGE DU POST -->
            <img src="./imageUpload/<?= $post['photoPost'] ?>" class="w-100" alt="">
            <p> <?= $post['create_at'] ?> </p>

            <!-- FORMULAIRE LIKE -->
            <i class="fa-regular fa-heart" style="color: #000000;"> Nombre de likes</i>
            <form action="./post.php" method="post">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <button type="submit" class="btn"> </button>
            </form>
            <i class="fa-regular fa-comment" style="color: #000000;"> Nombre de commentaires</i>
        </div>

        <div class="col">
            <!-- AFFICHER LES COMMENTAIRES -->
            <?php
            foreach ($comment as $comment) { ?>
                <p> <?= $comment['pseudo'] ?>,
                 <?= $comment['created_at'] ?>:
                <?= $comment['content'] ?> </p>
            <?php } ?>

            <!-- FORMULAIRE COMMENTAIRE -->
            <form action="./process/add_comment.php" method="post">
                <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                <input class="w-100" type="text" name="content" id="content">
                <button type="submit" class="btn btn-outline-dark"> COMMENTER </button>
            </form>
        </div>
    </div>
</div>

</div>

<?php
include './partials/footer.php';
?>