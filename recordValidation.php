<?php
//inserting into table zaznamy 
session_start();
$_SESSION["delete_alter"] = true;
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["subInsert"])) {
function get_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  //priprava promennych
  $date = date('Y-m-d');
  $userID = $_SESSION["userID"];
  $time = get_input($_POST["time"]);
  $rating = get_input($_POST["rating"]);
  $note = get_input($_POST["note"]);
  $lang = get_input($_POST["jazyk"]); 


  include("DBconnection.php");

  // Check connection
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }
  
  $sql = "INSERT INTO zaznamy (ID_users, Datum, ProgramJazyk, CasMin, Hodnoceni, Poznamka)
  VALUES ($userID, '$date', '$lang', $time, $rating, '$note')";

  if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $connection->error;
  }
  $connection->close();
}
header("Location:app.php");
?>