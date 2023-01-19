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
$connection->close();
//variables $password, $email, $username

//creating cookie variables
?>


<div class="profile"><i class= "fa-solid fa-circle-user profilePic"></i>
    <div class="uname"><span class = "prof1">Username : </span><span class = "prof2"><?php echo " ".$username; ?></span></div>
    <div class="password"><span class = "prof1">Password : </span><span class = "prof2">********</span></div>
    <div class="email"><span class = "prof1">E-mail : </span><span class = "prof2"><?php echo " ".$email; ?></span></div>
    <form method = "POST">
        <input type = "submit" class = "submitProf" name = "alter" value = "Change username or password">
    </form>   
</div>
