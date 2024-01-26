<?php
session_start();
include './partials/header.php';
include './partials/navbar.php';
require_once './config/connexion/connexion.php';


//AFFICHER LES POSTS
$prepareRequest= $connexion->prepare(
    'SELECT * FROM `post` WHERE user_id = ? ORDER BY create_at DESC');
$prepareRequest->execute([
     $_POST['user_id']
]);
$post_other = $prepareRequest->fetchAll(PDO::FETCH_ASSOC); ?>


<div class="container border border-dark rounded-3 p-5">
    <?= $_POST['pseudo']; ?>'s profile <br>

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
    <!-- FORMULAIRE POUR ALLER VOIR LE POST EN CLIQUANT SUR LA PHOTO -->
    <form action="./post.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $post_other['id'] ?>">
                    <input type="hidden" name="pseudo" value="<?= $_SESSION['pseudo'] ?>">
                    <button class="btn" type="submit">
                    <img src="./imageUpload/<?= $post_other['photoPost'] ?>" class="w-100" alt="">
                    </button>
    </form>                
    
    <p><?= $post_other['create_at'] ?></p>
    <p><?= $post_other['content'] ?></p>
    <form action="./process/add_like.php" method="post">
        <input type="hidden" name="post_id" value="<?= $post_other['id'] ?>">
        <button type="submit" class="btn"> <?= $like['0'] ?> <i class="fa-regular fa-heart" style="color: #000000;"> </i> </button>
    </form>
    
    <form action="./post.php" method="post">
            <input type="hidden" name="post_id" value="<?= $post_other['id'] ?>">
            <input type="hidden" name="pseudo" value="<?= $_SESSION['pseudo'] ?>">
                <button type="submit" class="btn"> <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment ['0'] ?> </i> </button>
    </form>
<?php } ?>


<?php
include './partials/footer.php';
?>