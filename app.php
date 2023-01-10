<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>ProTrain</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='app.css'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/9d291e9016.js" crossorigin="anonymous"></script>
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
            <div id="loginIcon"><i class="fa-solid fa-user"></i></div>
            <input type = "submit" name = "profile" id ="fill4" class = "tab" value = "<?php echo $login; ?>   ">
          </div>                
      </div>
      <div class="seg2">
        <form method = 'post' class = 'navi'>     
          <div class="section" id = "tab1"><i class="fa-solid fa-chart-simple"></i><input type = "submit" name = "dashboard" id ="fill1" class = "tab" value = "Dashboard"></div>
          <div class="section" id = "tab2"><i class="fa-solid fa-plus"></i><input type = "submit" name = "newRec" id = "fill2" class = "tab" value = "Create new"></div>      
          <div class="section" id = "tab3"><i class="fa-solid fa-table-list"></i><input type = "submit" name = "allRecs" id ="fill3" class = "tab" value = "Show records"></div>
          <div class="section" id = "tab4"><i class="fa-solid fa-user"></i><input type = "submit" name = "profile" id ="fill4" class = "tab" value = "Profile"></div> 
        </form>
      </div>
      <div class="seg3">
        <div class = "test1"><a href="login.php">Log Out</a></div>
        <div class= "test2"><i class="fa-solid fa-sliders"></i></div>
      </div>
    </div>
    
<div class="content">
  
    <div class="content1">
      <?php
        include "menuAnimation.php";
      ?>
    </div>
    <?php
      if(isset($_POST["allRecs"])){

      }
      else{
        include("dailyGoalTab.php");
      }
    ?>
    
    
</div>

</div>




</body>
</html>