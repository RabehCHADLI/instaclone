<?php
session_start();
include './partials/header.php';
// include './navbar.php';
?>


<div class="index container border border-secondary border-1 rounded-3 p-5">
  <a href="./index.php">
    <img src="./assets/images/logo_blanc.png" alt="logo" class="logo mx-auto d-block">
  </a>
  <form action="./process/add_user_connexion.php" method="post">
    <div class="mb-3 text-center">
      <label for="pseudo" class="form-label"></label>
      <input type="text" class="form-control rounded-pill mt-3" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
    </div>
    <button type="submit" class="btn btn-outline-secondary mx-auto d-block mt-5">Connexion</button>
  </form>
</div>

<?php
// include './partials/footer.php';
?>