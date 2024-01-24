<?php
session_start();
include './partials/header.php';
include './partials/navbar.php';
?>
<div class="container border border-secondary rounded-3  d-flex justify-content-center ">
<div class=" m-3 " style="width: 30rem;">
  <div class="card-body">
    <h5 class="card-title">Create a post</h5>
    <h6 class="card-subtitle mb-2 text-muted">Select a picture</h6>
    <form action="./process/add_post.php" method="post" enctype="multipart/form-data">
                <div class="mb-3 mt-3 mx-auto d-block">
                    <label for="file" class="form-label"></label>
                    <input type="file" name='image' id="image">
                    <label for="caption" class="form-label"></label>
                    <input type="text" class="form-control rounded-pill mt-3 w-100 mx-auto d-block" name="content" id="content" placeholder="caption">
                </div>
                <button class="btn btn-outline-dark mx-auto d-block mt-5 mb-3">Publier</button>
            </form>
  </div>
</div>


<?php
include './partials/footer.php';
?>