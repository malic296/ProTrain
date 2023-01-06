<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>DB testing</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
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
//DB variables
$DBservername = "mysql.hostify.cz";
$DBusername = "db_28564_ProTrain";
$DBpassword = "ProTrain2022";
$db = "db_28564_ProTrain";

  echo "debug window: <br>";
  echo "<fieldset>";
if (isset($_POST["subLogin"])) {
  //login
  $login = get_input($_POST["login"]);
  $password = get_input($_POST["password"]);
  echo "user login input: <br>";
  echo "login: $login, password: $password";
} elseif (isset($_POST["subReg"])) {
  //register
  $login = get_input($_POST["loginRegister"]);
  $password = get_input($_POST["passwordRegister"]);
  $email = get_input($_POST["emailRegister"]);
  echo "register input: <br>";
  echo "login: $login, password: $password, email: $email <br><br>";

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
      $stmt->bind_param("sss", $login, $password, $email);
      $stmt->execute();
      echo "succes reg";
      $stmt->close();
      $connectDB->close();
    }
    
  }
}
echo "<br><br>";
//connecting to DB
echo "DB: <br>";
$conn = new mysqli($DBservername, $DBusername, $DBpassword, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sqlComm = "select * from users where login = '$login' "; //prikaz pro SQL
$result = $conn->query($sqlComm);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "Logged as:<br> id: " . $row["ID_users"] . "<br>login: " . $row["login"] . "<br>password: " . $row["password"] . "<br>email: " . $row["email"] . "<br>";
    $DBuserID = $row["ID_users"];
    $DBuserLogin = $row["login"];
    $DBuserPassword = $row["password"];
    $DBuserEmail = $row["email"];
  }
} else {
  die("This user does not exist");
}
$conn->close();
echo "<br>";

//password verification
if ($password == $DBuserPassword) {
  echo "login succesful";
} else {
  die("wrong password");
}
echo "</fieldset>";
echo "<br><br> formulář: ";
?>
<fieldset>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    čas v minutách: <input type="number" name="time" min="0"><br><br>
    Datum od: <input type="date" name="dateFrom"><br><br>
    Datum do: <input type="date" name="dateTo"><br><br>
    Programovací jazyk <select name="jazyk">
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
    Hodnocení 1-5: <input type="number" name="rating" min="1" max="5"><br><br>
    Poznámka: <textarea name="note"></textarea><br>
    <input type="submit" name="subInsert">
  </form>
</fieldset>
<?php

//odesílání dat z formuláře do sql
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["subInsert"])) {
  //priprava promennych
  $rawDateFrom = htmlentities($_POST['dateFrom']);
  $rawDateTo = htmlentities($_POST['dateTo']);
  $dateFrom = date('Y-m-d', strtotime($rawDateFrom));
  $dateTo = date('Y-m-d', strtotime($rawDateTo));
  $lang = get_input($_POST["jazyk"]);
  $time = get_input($_POST["time"]);
  $rating = get_input($_POST["rating"]);
  $note = get_input($_POST["rating"]);

  $conn = new mysqli($DBservername, $DBusername, $DBpassword, $db);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO zaznamy (ID_users, DatumDO, DatumDO, ProgramJazyk, CasMin, Hodnoceni, Poznamka)
  VALUES ($DBuserID, '$dateFrom', '$dateTo', $lang, $time, $rating, $note)";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}

echo "<br><br>";
//connecting to DB
echo "Zaznamy: <br>";
$conn = new mysqli($DBservername, $DBusername, $DBpassword, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sqlComm = "select * from zaznamy where ID_users = $DBuserID "; //prikaz pro SQL
$result = $conn->query($sqlComm);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "id: " . $row["ID_zaznamy"] . " your ID: " . $row["ID_users"] . " Datum od: " . $row["DatumOD"] . " Datum do: " . $row["DatumDO"]. " Programovaci jazyk: " . $row["ProgramJazyk"]. " Cas: " . $row["CasMin"]. " Hodnoceni: " . $row["Hodnoceni"]. " Poznamka: " . $row["Poznamka"] . "<br>";
  }
} else {
  die("Nemáte žádné záznamy");
}
$conn->close();
?>
</body>
</html>