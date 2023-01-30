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
  <link rel="icon" type="image/x-icon" href="logo.ico">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
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
    $DBDailyGoal = $row["dailyGoal"];
  }
} else {
    header("Location:index.php");
  die("This user does not exist");
}
if(isset($_POST["save"])){
  include "profAlterValidation.php";
}

$connection->close();

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
        
      </div>
      <div class="seg3">
          <div class = "test1"><a href="index.php">
            Log Out</a>
          </div>
          <button type = "submit" class = "test2" name = settings>
            <i class="fa-solid fa-sliders"></i>
          </button>
      </div>
      </form>
    </div>
    
<div class="content">
  
  <div class="content1">
      <?php
      if($_SESSION["noteCheck"] == true){
        include "recordTable.php";
        echo "
        <style>
        .content1{
          width:100%;
          display:flex;
          flex-direction:row;
          border-radius:0px;
          background-color: #DEDDDD;
          box-shadow:none;
        }
        .filtrace{
          display:flex;
          justify-content:center;
          align-items:center;
          box-shadow: 3px 3px 13px #878787;
          margin-left: 10px;
          border-radius:10px;
          background-color:white;

        }
        .vysledky{
          box-shadow: 3px 3px 13px #878787;
          border-radius:10px;
          background-color:white;
        }
         
        </style>";
      }
      else if(isset($_POST["enter"])){
        include "alterCreation.php";
      }
      else if(isset($_POST["alter"])){
        include "UsrPrf.php";
      }
      else if(($_SESSION["delete_alter"] == true) or isset($_POST["filter"])){
        include "recordTable.php";
        echo "
        <style>
        .content1{
          width:100%;
          display:flex;
          flex-direction:row;
          border-radius:0px;
          background-color: #DEDDDD;
          box-shadow:none;
        }
        .filtrace{
          display:flex;
          justify-content:center;
          align-items:center;
          box-shadow: 3px 3px 13px #878787;
          margin-left: 10px;
          border-radius:10px;
          background-color:white;

        }
        .vysledky{
          box-shadow: 3px 3px 13px #878787;
          border-radius:10px;
          background-color:white;
        }
         
        </style>";
        
      }
      
      else{
        include "menuAnimation.php";
      }
      ?>
    </div>
    <?php
      if($_SESSION["noteCheck"] == true){
        echo "<div class = 'content2'>";
        echo "<text class = 'noteField'>".$_SESSION['note']."</text>";
        echo "</div>";
        echo "
        <style>
        .content1{
          width:100%;
          justify-content:left;
          
          box-shadow:none;
          margin-right: 0px;
          margin-left: 15px;
        }

        .content2{
          font-family: 'Poppins', cursive;
          height:100%;
          margin-left:10px;
          padding:10px;
          width:0%;
          overflow-wrap: anywhere;
          animation: bigger 1s normal forwards ease-in-out;
          position:relative;
        }
        .vysledky{
          margin-right:10px;
          width:100%;
          animation: smaller 1s normal forwards ease-in-out;
        }
                
        </style>";
        }
      
      else if(isset($_POST["allRecs"])){
        
      }
      else if(isset($_POST["filter"])){

      }
      else if($_SESSION["delete_alter"] == false){
        include("dailyGoalTab.php");
      }
      else if(isset($_POST["newRec"])){
        include("dailyGoalTab.php");
      }
      else{}
      $_SESSION["noteCheck"] = false;
      $_SESSION["delete_alter"] = false;
    ?>
    
    
</div>

</div>




</body>
</html>
