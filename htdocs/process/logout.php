<?php
session_start();
session_destroy();
header('Location: ../../out.php?error=A bientot');
?>