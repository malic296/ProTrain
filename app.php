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
  <link rel='stylesheet' type='text/css' media='screen' href='test.css'>
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

  echo "debug window: <br>";
  echo "<fieldset>";
if (isset($_POST["subLogin"])) {
  //login
  $login = get_input($_POST["login"]);
  $password = get_input($_POST["password"]);

  $secret = passwordEnc($password);

  echo "user login input: <br>";
  echo "login: $login, password: $secret";
  $_SESSION["login"] = $login;
  $_SESSION["password"] = $secret;

} elseif (isset($_POST["subReg"])) {
  //register
  $login = get_input($_POST["loginRegister"]);
  $password = get_input($_POST["passwordRegister"]);
  $email = get_input($_POST["emailRegister"]);
  echo "register input: <br>";
  echo "login: $login, password: $password, email: $email <br><br>";

  $secret = passwordEnc($password);

  $_SESSION["login"] = $login;
  $_SESSION["password"] = $secret;

  $connectDB = new mysqli($DBservername, $DBusername, $DBpassword, $db);
  if ($connectDB->connect_error) {
    die("Connection Failed : " . $connectDB->connect_error);
  } else {
    //kontrola jestli uzivatel uz neexistuje
    $sqlComm = "select * from users where login = '$login' ";
    $result = $connectDB->query($sqlComm);
    if ($result->num_rows > 0) {
      $connectDB->close();
      die("This username already exist");
    } else {
      //vytvoreni uzivatele a zapsani do databaze
      $stmt = $connectDB->prepare("insert into users(login, password, email) values(?, ?, ?)");
      $stmt->bind_param("sss", $login, $secret, $email);
      $stmt->execute();
      echo "succes reg";
      $stmt->close();
      $connectDB->close();
    }
  }
}
echo "<br><br>";

//getting info from table users
echo "DB: <br>";
include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
$session_login = $_SESSION["login"];
$sql = "select * from users where login = '$session_login'"; //prikaz pro SQL
$result = $connection->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "Logged as:<br> id: " . $row["ID_users"] . "<br>login: " . $row["login"] . "<br>password: " . $row["password"] . "<br>email: " . $row["email"] . "<br>";
    $DBuserID = $row["ID_users"];
    $_SESSION["userID"] = $DBuserID; 
    $DBuserLogin = $row["login"];
    $DBuserPassword = $row["password"];
    $DBuserEmail = $row["email"];
  }
} else {
  die("This user does not exist");
}
$connection->close();
echo "<br>";

//password verification
if ($_SESSION["password"] == $DBuserPassword) {
  echo "login succesful";
} else {
  die("wrong password");
}
echo "</fieldset>";
echo "<br><br> formulář: ";

?>
<fieldset>
  <form action="recordValidation.php" method="post"> 
    čas v minutách: <input type="number" name="time" min="0" required><br><br>
    Datum od: <input type="date" name="dateFrom" required><br><br>
    Datum do: <input type="date" name="dateTo" required><br><br>
    Programovací jazyk <select name="jazyk" required>
      <option value="C++">C++</option>
      <option value="C">C</option>
      <option value="C#">C#</option>
      <option value="Python">Python</option>
      <option value="HTML">HTML</option>
      <option value="CSS">CSS</option>
      <option value="SQL">SQL</option>
      <option value="Rust">Rust</option>
      <option value="JavaScript">JavaScript</option>
    </select><br><br>
    Hodnocení 1-5: <input type="number" name="rating" min="1" max="5" required><br><br>
    Poznámka: <textarea name="note" required></textarea><br>
    <input type="submit" name="subInsert" required>
  </form>
</fieldset>

<?php

echo "<br><br>";
//printing from table zaznamy
echo "Zaznamy: <br>";
include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
$sql = "select * from zaznamy where ID_users = $DBuserID "; //prikaz pro SQL
$result = $connection->query($sql);
echo "<table>";
echo "<tr> <th>ID_zaznam</th> <th>your ID</th> <th>Datum od</th> <th>Datum do</th> <th>Programovaci jazyk</th> <th>Cas</th> <th>Hodnoceni</th> <th>Poznamka</th> </tr>";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $DBzaznamID = $row["ID_zaznamy"];
    echo "<tr> <td>$DBzaznamID</td> <td>".$row["ID_users"]."</td> <td>".$row["DatumOD"]."</td> <td>".$row["DatumDO"]."</td> <td>".$row["ProgramJazyk"]."</td> <td>".$row["CasMin"]."</td> <td>".$row["Hodnoceni"]."</td> <td>".$row["Poznamka"]."</td>" . "<td><a href='recordDelete.php?id=$DBzaznamID' class='deleteButton'>Delete</a></td></tr>";
  }
} else {
  echo "Nemáte žádné záznamy";
}
echo "</table>";
$connection->close();

?>
</body>
</html>