<?php
session_start();
include './partials/header.php';
// include './navbar.php';
if (!empty($_GET['error'])) {
  echo '<div class="alert alert-danger" role="alert">' . $_GET['error'] . '</div>';
}
?>

<div class='container'>
  <div class="row d-flex justify-content-center">


    <div class="border border-secondary border-1 rounded-3 p-5 col-5 m-2">
      <a href="./index.php">
        <img src="./assets/images/logo_blanc.png" alt="logo" class="logo mx-auto d-block">
      </a>
      <h3 class="text-center mt-3">CONNEXION</h3>
      <form action="./process/login.php" method="post">
        <div class="mb-3 text-center">
          <label for="pseudo" class="form-label"></label>
          <input type="text" class="form-control rounded-pill mt-3" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
        </div>
        <div class="mb-3 text-center">
          <label for="password" class="form-label"></label>
          <input type="password" class="form-control rounded-pill mt-3" name="password" id="password" placeholder="Mot de pass">
        </div>

        <button type="submit" class="btn btn-outline-secondary mx-auto d-block mt-5">Connexion</button>
      </form>
    </div>
    <!-- INSCRIPTION -->
    <div class="border border-secondary border-1 rounded-3 p-5 col-5 m-2">
      <a href="./index.php">
        <img src="./assets/images/logo_blanc.png" alt="logo" class="logo mx-auto d-block">
      </a>
      <h3 class="text-center mt-3">INSCRIPTION</h3>
      <form action="./process/add_user.php" method="post">
        <div class="mb-3 text-center">
          <label for="pseudo" class="form-label"></label>
          <input type="text" class="form-control rounded-pill mt-3" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
        </div>
        <div class="mb-3 text-center">
          <label for="password" class="form-label"></label>
          <input type="password" class="form-control rounded-pill mt-3" name="password" id="password" placeholder="Mot de pass">
        </div>

        <button type="submit" class="btn btn-outline-secondary mx-auto d-block mt-5">Inscription</button>
      </form>
    </div>
  </div>
</div>

<?php
// include './partials/footer.php';
?>