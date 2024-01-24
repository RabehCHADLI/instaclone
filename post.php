<?php
include './partials/header.php';
include './partials/navbar.php';
require_once './config/connexion/connexion.php';

//AFFICHER LE NOMBRE DE LIKES
$prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM likes WHERE likes.post_id = ?');
$prepareRequest->execute([
    $_POST['post_id']
]);
$like = $prepareRequest->fetch(); 

//AFFICHER LE NOMBRE DE COMMENTAIRES
$prepareRequest = $connexion->prepare('SELECT COUNT(*) FROM comments WHERE comments.post_id = ?');
$prepareRequest->execute([
    $_POST['post_id']
]);
$nbcomment = $prepareRequest->fetch(); 

// AFFICHER LE POST + SES LIKES
$prepareRequest = $connexion->prepare(
    'SELECT * FROM post WHERE post.id = ?'
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
            <h4 class="fw-bold"> <?= $_POST['pseudo'] ?> </h4>

            <!-- IMAGE DU POST -->
            <img src="./imageUpload/<?= $post['photoPost'] ?>" class="w-100" alt="">
            <p> <?= $post['create_at'] ?> </p>

            <!-- FORMULAIRE LIKE -->
            <i class="fa-regular fa-heart" style="color: #000000;"> <?= $like['0'] ?> </i>
            <form action="./post.php" method="post">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <button type="submit" class="btn"> </button>
            </form>
            <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment['0'] ?></i>
        </div>

        <div class="col">

            <!-- AFFICHER LES COMMENTAIRES -->
            <div id="scroll" class="border rounded-3 border-dark border-2 p-1 row">
                <?php
                foreach ($comment as $comment) { ?>
                    <p> <?= $comment['pseudo'] ?>,
                        <?= $comment['created_at'] ?>:
                        <?= $comment['content'] ?> </p>
                <?php } ?>
            </div>
            
                <!-- FORMULAIRE COMMENTAIRE -->
                <form action="./process/add_comment.php" method="post">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <input class="w-100 rounded-3" type="text" name="content" id="content" placeholder="Votre commentaire">
                    <button type="submit" class="btn btn-outline-dark mt-2"> COMMENTER </button>
                </form>
        </div>
    </div>
</div>
</div>
</div>

</div>

<?php
include './partials/footer.php';
?>