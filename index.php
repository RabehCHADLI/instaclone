<?php
session_start();
include './partials/header.php';
?>

<div class="index container border border-danger border-2 rounded-2 w-25 p-5">
  <a href="./assets/images/logo.png">
    <img src="./assets/images/logo.png" alt="logo" class="mx-auto d-block">
  </a>
  <form action="./process/add_user_connexion.php" method="post">
    <div class="mb-3 text-center">
      <label for="pseudo" class="form-label"></label>
      <input type="text" class="form-control rounded-pill mt-5" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
    </div>
    <button type="submit" class="btn btn-outline-danger mx-auto d-block mt-5">Connexion</button>
  </form>
</div>

<?php
include './partials/footer.php';
?>