 <!-- AFFICHER LA DATE DE CREATION -->
 <p><?= $value['create_at'] ?></p>

<!-- FROMULAIRE POUR AJOUTER UN ECHO UN LIKE -->
    <form action="./process/add_like.php" method="post">
        <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
        <button type="submit" class="btn"> <i class="fa-regular fa-heart" style="color: #000000;"> <?= $like['0'] ?> </i> </button>
    </form>

<!-- FORMULAIRE POUR AJOUTER ET ECHO LES COMMENTAIRES -->
    <form action="./post.php" method="post">
        <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
        <input type="hidden" name="pseudo" value="<?= $_SESSION['pseudo'] ?>">
        <button type="submit" class="btn"> <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment['0'] ?> </i> </button>
    </form>

<!-- AFFICHER LA CAPTION -->
    <p><?= $value['content'] ?></p>
    