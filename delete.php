<?php
require_once 'pdo.php';
session_start();

$stmt=$pdo->prepare("DELETE FROM USERS WHERE userid=:uid ");
$stmt->execute(array(':uid'=>$_SESSION['userid']));

setcookie('username', false, 1,"/");

session_destroy();

header('Location: index.php');
return;
?>
