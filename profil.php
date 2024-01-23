<?php
session_start();
// include './config/connexion/debug.php';
include './partials/header.php';
include './partials/navbar.php';

// Connexion BDD
require_once '../htdocs/config/connexion/connexion.php';


//Préparation de la requête
$preparedRequestProfil = $connexion->prepare(
    "SELECT * FROM User WHERE id = ?"
);

//Execute la requête
$preparedRequestProfil->execute([
    $_SESSION['id']
]);

//Recupère les données de la requête
$profil = $preparedRequestProfil->fetch(PDO::FETCH_ASSOC);


?>

<div class="container border border-dark rounded-3">
    AJOUTER PHOTO DE PROFIL ?? <br>
    Bonjour <?= $_SESSION['pseudo']; ?> <br>
    AFFICHER VOS POST
</div>

<?php
include './partials/footer.php';
?>