<?php
session_start();
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
<div class="container_post container border border-dark rounded-3">
    <div class="container row">
        <div class="col col_post">

            <!-- AUTEUR DU POST -->
            <h4 class="fw-bold"> <?= $_POST['pseudo'] ?> </h4>

            <!-- IMAGE DU POST -->
            <img src="./imageUpload/<?= $post['photoPost'] ?>" class="w-100 custom-image" alt="">
            <p> <?= $post['create_at'] ?> </p>

            <!-- FORMULAIRE LIKE -->
            <form action="./post.php" method="post" id="formlike">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <button type="submit" class="btn" onclick="changeColor(this)"> <i class="fa-regular fa-heart" style="color: #000000;"></i></button><span id="spanlikes"></span>
            </form>
            <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment['0'] ?></i>
        </div>

        <div class="col col_post">

            <!-- AFFICHER LES COMMENTAIRES -->
            <div id="scroll" class="border rounded-3 border-dark border-2 p-1 row">
                <div id="listComment">
                </div>
            </div>
            <div class="" id="message_send_comment"></div>

            <!-- FORMULAIRE COMMENTAIRE -->
            <form action="./process/add_comment.php" method="post" id="form_comment">
                <input type="hidden" name="post_id" id="post_id" value="<?= $post['id'] ?>">
                <input class="w-100 rounded-3" type="text" name="content" id="content_com" placeholder="Votre commentaire">
                <button type="submit" class="btn btn-outline-dark mt-2"> COMMENTER </button>
            </form>
        </div>
    </div>
</div>


<script src="./assets/js/script_like.js"></script>
<script src="./assets/js/script.js"></script>
<?php
include './partials/footer.php';
?>