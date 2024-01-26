<?php
session_start();
require_once "./config/connexion/connexion.php";
include "./partials/header.php";
include "./partials/navbar.php";
$sql = "SELECT * FROM User WHERE pseudo LIKE" . "'" . "%" . $_POST['recherche'] . "%" . "'";
$object = $connexion->query($sql);
$user = $object->fetch(PDO::FETCH_ASSOC);

if ($user) {?>

  
    <div class="container card bg-secondary-subtle mt-5 p-2" style="width: 18rem;">
      <img src="./imageUpload/<?=$user['photo_profil']?>" class="card-img-top rounded-5" alt="...">
      <div class="card-body">
        <h5 class="card-title fw-bold"><?=$user['pseudo']?></h5>
        <form action="./profil_other.php" method='post' >
            <input type="hidden" name="user_id" value='<?=$user['id']?>'>
            <input type="hidden" name="pseudo" value='<?=$user['pseudo']?>'>
            <button class="btn btn-primary">Profil de <?=$user['pseudo']?> </button>
        </form>
      </div>
    </div>
<?php
}else{
    
    ?>  
    <h2 class="text-center m-5">Votre recherche n'a pas abouti</h2>

<?php } ?>