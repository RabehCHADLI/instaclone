<?php
include './partial/header.php';
session_start();
var_dump($_SESSION)
?>
<form action="./process/addPost.php" method="post" >

<input type="text" name="content" id="content" placeholder="caption">
<input type="file" name='image' id="image">
<button>ici</button>

</form>























<?php

include './partial/footer.php';


?>