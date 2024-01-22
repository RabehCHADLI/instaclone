<?php
$uploads = "../../imageUpload";
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];
$addpict = move_uploaded_file($tmp_name, $uploads . '/' .$name );


?>