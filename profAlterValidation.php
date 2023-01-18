<?php
$DBuserID = $_SESSION["userID"];
$username = $_POST["unameAltered"];
$password = $_POST["passwdAltered"];

$pepper = "c1ebvFdxMDrmkOqvxpilFw";
$secret= hash_hmac("sha256", $password, $pepper);
return $secret;
$password = $secret;

$username = trim($username);
$username = stripslashes($username);
$username = htmlspecialchars($username);
return $username;

$sql = "SELECT login FROM users WHERE login = '$username'";
$result = $connection->query($sql);
if ($result->num_rows > 0) {   
    $_SESSION["test"] = 10;

    }
    
else{
    $sql = "UPDATE `users` SET `login` = '$username' WHERE `users`.`ID_users` = $DBuserID";
    $connection->query($sql);
    $_SESSION["test"] = 20;

}

?>