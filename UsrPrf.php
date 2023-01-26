<?php
//variables
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$DBuserID = $_SESSION["userID"];
include "DBconnection.php";
$sql = "SELECT login from users where ID_users = $DBuserID;";
$result = $connection->query($sql);
$uname = $result->fetch_assoc();
$username = $uname["login"];

$sql = "SELECT email from users where ID_users = $DBuserID;";
$result = $connection->query($sql);
$mail = $result->fetch_assoc();
$email = $mail["email"];

$sql = "SELECT password from users where ID_users = $DBuserID;";
$result = $connection->query($sql);
$passwd = $result->fetch_assoc();
$password = $passwd["password"];
//variables $password, $email, $username

//email vars
$subject = "Profile Modification";
$code = rand(1000000,9999999);
$_SESSION["CODE"] = $code;
$message = "Your verification code is $code";

$smtpServer = "smtp.gmail.com";
$smtpName = "ProTrain.Application@gmail.com";
$smtpPassword = "lkhxfcwneeqdsuyh";

$fromName = "ProTrain";

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

//cookie creation to check time
$cookie_name = "user".rand(1,999999);
$cookie_value = true;
$_SESSION["cookieVer"] = $cookie_name;
setcookie($cookie_name, $cookie_value,time() + 120);

?>
<div class="profile">
    <i class= "fa-solid fa-circle-user profilePic"></i>
    <h1 class = "usrEnter">Enter your verification code:</h1><br>
    <form method = "POST" class = "prfInput">
        <input class = "input help2" type = text name = "verificationCode" required><br><br>
        <input type = "submit" value = "Enter" name = "enter" class ="submitProf help">
    </form>

        
    
</div>