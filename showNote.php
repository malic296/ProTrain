<?php
session_start();
$_SESSION["note"] = $_POST["threeDots"];
$_SESSION["noteCheck"] = true;
header("Location: app.php");

?>