<?php
session_start();

$_SESSION['pingche_userid'] = "";
$_SESSION['pingche_username'] = "";
setcookie("pingche_username", "", time()-1);
$_SESSION['pingche_usercount'] = "";

header("Location: index.php");
?>

