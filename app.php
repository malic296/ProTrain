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
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
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
<header>
<?php 
//echo "<div class = 'head2'>";
//echo "$login <br>";
//echo "$secret <br>";
//echo "$DBuserID <br>";
//echo "$DBuserEmail <br>";
//echo "</fieldset>"; 
//echo "</div>"

//později dořešit a odkomentovat



if($_SESSION["animace"] == 1){
  echo "<div class='head head1'>ProTrain</div>";
}
else{
  echo "<div class='head'>ProTrain</div>";
}


$_SESSION["animace"] = 2;
?>
</header>


<div class="all">
    <?php
      if($_SESSION["animace2"] == 1){
        echo "<form method = 'post' class = 'navi seen'>";
      }
      else{
        echo "<form method = 'post' class = 'navi'>";
      }
      $_SESSION["animace2"] = 2;
    ?>
    
      <div class = "rows">
        <div class="section"><input type = "submit" name = "recordForm" class ="fill" value = "Vytvoř si svůj Záznam!"></div>
        <div class="section"><input type = "submit" name = "recordTable" class ="fill" value = "Zobraz si své záznamy!"></div>
      </div>

      <div class="rows">
        <div class="section"><input type = "submit" name = "3" class ="fill" value = "3"></div>
        <div class="section"><input type = "submit" name = "4" class ="fill" value = "4"></div>
      </div>
    </form>
</div>
<div class="content">
  
  <?php
    
    if(isset($_POST["recordForm"])){
      include "recordForm.php";
    }
    else if(isset($_POST["recordTable"])){
      include "recordTable.php";
    }
    else if(isset($_POST["3"])){
      echo "3";
    }
    else if(isset($_POST["4"])){
      echo "4";
    }
    else{
     
    }

  
  ?>


</div>




</body>
</html>