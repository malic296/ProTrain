<?php
session_start();
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
//register
$login = get_input($_POST["loginRegister"]);
$password = get_input($_POST["passwordRegister"]);
$email = get_input($_POST["emailRegister"]);

$secret = passwordEnc($password);

include("DBconnection.php");
$connectDB = new mysqli($DBservername, $DBusername, $DBpassword, $db);
if ($connectDB->connect_error) {
  die("Connection Failed : " . $connectDB->connect_error);
} else {
  //kontrola jestli uzivatel uz neexistuje
  $sqlComm = "select * from users where login = '$login' ";
  $result = $connectDB->query($sqlComm);
  if ($result->num_rows > 0) {
    $connectDB->close();
    header("Location:signup.php?error=1");
  } else {
    //vytvoreni uzivatele a zapsani do databaze
    $stmt = $connectDB->prepare("insert into users(login, password, email) values(?, ?, ?)");
    $stmt->bind_param("sss", $login, $secret, $email);
    $stmt->execute();
    echo "succes reg";
    $stmt->close();
    $connectDB->close();

    $_SESSION["login"] = $login;
    $_SESSION["password"] = $secret;
    header("Location:app.php");
    exit();
  }
}
?>