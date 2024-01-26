<?php foreach ($post as $value) {
    //REQUETES SQL 
?>


    <div class="card m-3" style="width: 30rem;">
    <!-- AUTEUR DU POST -->
        <form action="./profil_other.php" method="post">
            <h5 class="card-title">
                <button class="btn" type="submit">
                    <img src="./imageUpload/<?= $value['photo_profil'] ?>" class="picc2 m-2 border rounded-circle m-3" style="clip-path:ellipse(50% 30%); clip-path:ellipse(50% 50%); height:100px;">
                    <?= $value['pseudo'] ?>
                </button>
                <span class="fw-bold fs-4 text-uppercase"><?= $value['pseudo'] ?></span>
                <input type="hidden" name="user_id" value="<?= $value['user_id'] ?>">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
            </h5>
        </form>
        <!-- VOIR LE POST -->
        <form action="./post.php" method="post">
            <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
            <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
            <button class="btn" type="submit">
                <img src="./imageUpload/<?= $value['photoPost'] ?>" style="width: 30rem;" alt="photo du post">
            </button>

        
        <div class="card-body">
        <!-- LIKE -->
        <form action="./process/add_like.php" method="post">
            <h5 class="card-title">
            <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <button type="submit" class="btn"> <i class="fa-regular fa-heart" style="color: #000000;"> <?= $like['0'] ?> </i> </button>
            </h5>
            </form>

        <!-- COMMENT -->
        <form action="./post.php" method="post">
            <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
            <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
            <button type="submit" class="btn"> <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment['0'] ?> </i> </button>
        </form>
        <p class="card-text">here photo description</p>


            
           
        </div>
    </div>
<?php
} ?>

FEED.PHP
        <div class="container row">

            <!-- AUTEUR DU POST + PHOTO DE PROFIL -->
            <form action="./profil_other.php" method="post">
                <button class="btn" type="submit">
                    <img src="./imageUpload/<?= $value['photo_profil'] ?>" class="border rounded-circle m-3" style="clip-path:ellipse(50% 30%); clip-path:ellipse(50% 50%); height:100px;"> </button>
                <span class="fw-bold fs-4 text-uppercase"><?= $value['pseudo'] ?></span>
                <input type="hidden" name="user_id" value="<?= $value['user_id'] ?>">
                <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
            </form>

            <div class="image-grid d-flex justify-content-center">

                <!-- FORMULAIRE VOIR LE POST-->
                <!-- IMAGE DU POST -->
                <form action="./post.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                    <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
                    <button class="btn" type="submit">
                        <img src="./imageUpload/<?= $value['photoPost'] ?>" class="w-100 image_post_feed" alt="">
                    </button>
                    <p> <?= $value['create_at'] ?> </p>
                </form>

                <!-- METTRE LES LIKE / COMMENTAIRES EN DESSOUS DE LA PHOTO, A COTÉ DE LA DATE -->

                <div class="row">
                    <!-- FORMULAIRE LIKE -->
                    <form action="./process/add_like.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                        <button type="submit" class="btn"> <i class="fa-regular fa-heart" style="color: #000000;"> <?= $like['0'] ?> </i> </button>
                    </form>
                </div>
                <div class="row">
                    <!-- FORMULAIRE COMMENTAIRE -->
                    <form action="./post.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $value['id'] ?>">
                        <input type="hidden" name="pseudo" value="<?= $value['pseudo'] ?>">
                        <button type="submit" class="btn"> <i class="fa-regular fa-comment" style="color: #000000;"> <?= $nbcomment['0'] ?> </i> </button>
                    </form>
                </div>

            </div>


            <!-- AFFICHER LA CAPTION -->
            <p class="text-danger text-center caption"> <?= $value['content'] ?> </p>

            <hr>

        <?php  ?>
        </div>
</div>
