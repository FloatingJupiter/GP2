<?php
$_SESSION["username"]="";
$_SESSION["userid"]="";
session_start();
session_destroy();
header("Location: Login.php");
?>