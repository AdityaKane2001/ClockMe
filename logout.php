<?php

setcookie('username', false, 1,"/");

session_start();
session_destroy();

header('Location:index.php');
return;

 ?>
