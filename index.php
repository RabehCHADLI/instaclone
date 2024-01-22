<?php
session_start();
include './partials/header.php';
?>

<div class="container border border-light border-2 rounded-2 w-25 p-5">
  <a class="" href="./assets/images/logo.png">
    <img src="./assets/images/logo.png" alt="logo" class="d-block">
  </a>
  <form action="./process/add_user_connexion.php" method="post">
    <div class="mb-3 text-center">
      <label for="pseudo" class="form-label "></label>
      <input type="text" class="form-control rounded-pill" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
    </div>
    <button type="submit" class="btn btn-outline-danger">Connexion</button>
  </form>
</div>

<?php
include './partials/footer.php';
?>