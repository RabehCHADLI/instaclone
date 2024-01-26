<?php

require_once '../htdocs/config/connexion/connexion.php';
$preparedRequestProfil = $connexion->prepare(
  "SELECT * FROM User WHERE id = ?"
);
$preparedRequestProfil->execute([
  $_SESSION['id']
]);
$profil = $preparedRequestProfil->fetch(PDO::FETCH_ASSOC);

$preparedRequestPost = $connexion->prepare('SELECT * FROM User WHERE photo_profil = ?');
$preparedRequestPost->execute([
  $_SESSION['id']
]);

?>

<nav class="container navbar navbar-expand-lg border border-secondary mt-3 rounded-3 ">
  <div class="container-fluid ">
    <a class="navbar-brand" href="./feed.php">
      <img src="./assets/images/logo_blanc.png">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      </span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./profil.php">PROFIL</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#demo">CREATE</a>
        </li>
        <li class="nav-item mr-3">
          <a class="nav-link" href="./feed.php">FEED</a>
        </li>
        <form class="d-flex" role="search" method="post" action="../recherche.php">
          <input class="form-control me-2" name="recherche" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
        <li class="nav-item">
          <a class="nav-link " href="./process/logout.php">EXIT</a>
        </li>
      </ul>
      <a href="../profil.php"> <img src="./imageUpload/<?= $profil['photo_profil'] ?>" class="profile_picture_navbar border rounded-circle" style="clip-path:ellipse(50% 30%); height:200px;" alt=""></a>
    </div>
  </div>
</nav>

<div id="demo" class="modal">
  <div class="modal_content">
    <form action="./process/add_post.php" method="post" enctype="multipart/form-data">
      <div class="upload">
      <i class="fa-solid fa-file-circle-plus fa-2xl" style="color: #000000;"></i>
        <h2 class="browse">SELECT A PICTURE</h2>
        <input type="file" id="image" class="input-file" name='image'>
        <label for="caption" class="form-label"></label>
        <input type="text" class="form-control rounded-pill mt-3 w-100 mx-auto d-block" name="content" id="content" placeholder="caption">
        <button class="btn btn-outline-secondary d-flex mt-2" type="submit">SEND</button>
      </div>
    </form>
    <section class="p-5">
      <section class="container" id="">


        <a href="#" class="modal_close">&times;</a>
  </div>
</div>

<style>
  .modal {
    visibility: hidden;
    opacity: 1;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(133, 146, 144, 0.7);
    transition: all .6s;
  }

  .modal:target {
    visibility: visible;
    opacity: 1;
  }

  .modal_content {
    border-radius: 5px;
    position: relative;
    width: 1200px;
    max-width: 30%;
    background: white;
    padding: 1.5em 2em;
    display: flex;
    justify-content: center;
  }

  .modal_close {
    position: absolute;
    top: 50px;
    right: 50px;
    color: black;
    text-decoration: none;
  }
</style>