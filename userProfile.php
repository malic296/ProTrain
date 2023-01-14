<?php

//variables
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

//creating cookie variables
$cookie_name = $username;
$cookie_value = true;


?>
<div class="profile"><i class= "fa-solid fa-circle-user"></i></div>
<div class="profile">
    <div class="uname">Username : </div>
    <div class="uname"><?php echo " ".$username; ?></div>
</div>

<div class="profile">
    <div class="password">Password : </div>
    <div class="password">********</div>
</div>

<div class="profile">
    <div class="email">E-mail : </div>
    <div class="email"><?php echo " ".$email; ?></div>
</div>
<div class="profileButton">
    <form method = "post">
        <button type = "submit" class = "submit" value = "Alter" name = "alter">Alter</button>
    </form>
</div>
