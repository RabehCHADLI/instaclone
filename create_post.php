<?php
session_start();
include './partials/header.php';
include './partials/navbar.php';
// var_dump($_SESSION)
?>

<div class="container border border-dark rounded-3 text-center">
<form action="./process/addPost.php" method="post" enctype="multipart/form-data" >
    <div class="mb-3 mt-3 mx-auto d-block">
    <label for="file" class="form-label"></label>
    <input type="file" name='image' id="image">
    <label for="caption" class="form-label"></label>
    <input type="text" class="form-control rounded-pill mt-3 w-25 mx-auto d-block" name="content" id="content" placeholder="caption">
    </div>
    <button class= "btn btn-outline-dark mx-auto d-block mt-5 mb-3">Publier</button>
</form>
</div>


<?php
include './partials/footer.php';
?>