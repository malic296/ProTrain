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

//email vars
$subject = "Profile created";
$message = "Your profile has been successfully created";

$smtpServer = "smtp.gmail.com";
$smtpName = "ProTrain.Application@gmail.com";
$smtpPassword = "lkhxfcwneeqdsuyh";

$fromName = "ProTrain";

//register
$login = get_input($_POST["loginRegister"]);
$password = get_input($_POST["passwordRegister"]);
$email = get_input($_POST["emailRegister"]);

$secret = passwordEnc($password);

require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

    //mail
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $smtpServer;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = $smtpName;
    $mail->Password = $smtpPassword;

    $mail->setFrom($smtpName, $fromName);
    $mail->addAddress($email);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();


    header("Location:app.php");
    exit();
  }
}


?>
