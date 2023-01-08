<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>DB testing</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='app.css'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <script src='main.js'></script>
</head>

<body>

<?php

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

include("DBconnection.php");
$connection->close();


$login = $_SESSION["login"];
$secret = $_SESSION["password"];


//getting info from table users
include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
$session_login = $_SESSION["login"];
$sql = "select * from users where login = '$session_login'"; //prikaz pro SQL
$result = $connection->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $DBuserID = $row["ID_users"];
    $_SESSION["userID"] = $DBuserID;    
    $DBuserLogin = $row["login"];
    $DBuserPassword = $row["password"];
    $DBuserEmail = $row["email"];
  }
} else {
    header("Location:login.php");
  die("This user does not exist");
}
$connection->close();


?>

<?php 
//<header>
//echo "<div class = 'head2'>";
//echo "$login <br>";
//echo "$secret <br>";
//echo "$DBuserID <br>";
//echo "$DBuserEmail <br>";
//echo "</fieldset>"; 
//echo "</div>"

//později dořešit a odkomentovat
//</header>
?>

<div class="all">   
    <div class="menu">
      <div class="seg1">
        <h1>ProTrain</h1>
          <div class="loginName">
            <img src="assets/white/person.png" width="10%" class="imageIcon"><img>
            <?php
              echo $login;
            ?>   
          </div>                
      </div>
      <div class="seg2">
        <form method = 'post' class = 'navi'>     
          <div class="section"><img src="assets/white/display.png" width="15%" class="imageIcon"></img><input type = "submit" name = "dashboard" class ="fill1" value = "Dashboard"></div>
          <div class="section"><img src="assets/white/playButton.png" width="15%" class="imageIcon"></img><input type = "submit" name = "newRec" class = "fill2" value = "Create new"></div>      
          <div class="section"><img src="assets/white/displayForm.png" width="15%" class="imageIcon"></img><input type = "submit" name = "allRecs" class ="fill3" value = "Show records"></div>
          <div class="section"><img src="assets/white/person.png" width="15%" class="imageIcon"></img><input type = "submit" name = "profile" class ="fill4" value = "Profile"></div> 

        </form>
      </div>
      <div class="seg3">
        <div class = "test"><a href="login.php">Log Out</a></div>
      </div>
    </div>
    
<div class="content">
  
    <div class="content1">
      <?php
        include "menuAnimation.php";
      ?>
    </div>
    <div class="content2">
      <div class="goal1"><h1>Daily Goal</h1><br>circle</div>
      <div class="goal2">Latest records</div>
    </div>
</div>

</div>




</body>
</html>