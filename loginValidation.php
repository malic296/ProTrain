<?php
session_start();
$_SESSION["noteCheck"] = false;
$_SESSION["delete_alter"] = false;
function get_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function passwordEnc($password) {
    $pepper = "c1ebvFdxMDrmkOqvxpilFw";
    $secret= hash_hmac("sha256", $password, $pepper);
    return $secret;
  }
//login
$login = get_input($_POST["login"]);
$password = get_input($_POST["password"]);
$secret = passwordEnc($password);

include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

$sql = "select * from users where login = '$login'"; //prikaz pro SQL
$result = $connection->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $DBuserLogin = $row["login"];
    $DBuserPassword = $row["password"];
  }
} else {
    header("Location:index.php?error=1");
}
$connection->close();

//password verification
if ($secret == $DBuserPassword) {
    $_SESSION["login"] = $login;
    $_SESSION["password"] = $secret;
    header("Location:app.php");
    exit();
} else {
    header("Location:index.php?error=1");
}
  ?>