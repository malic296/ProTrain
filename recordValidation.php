<?php
//inserting into table zaznamy 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["subInsert"])) {
function get_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  //priprava promennych
  $userID = $_SESSION["userID"];
  $rawDateFrom = htmlentities($_POST['dateFrom']);
  $rawDateTo = htmlentities($_POST['dateTo']);
  $dateFrom = date('Y-m-d', strtotime($rawDateFrom));
  $dateTo = date('Y-m-d', strtotime($rawDateTo));
  $lang = get_input($_POST["jazyk"]);
  $time = get_input($_POST["time"]);
  $rating = get_input($_POST["rating"]);
  $note = get_input($_POST["note"]);

  include("DBconnection.php");

  // Check connection
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }

  $sql = "INSERT INTO zaznamy (ID_users, DatumOD, DatumDO, ProgramJazyk, CasMin, Hodnoceni, Poznamka)
  VALUES ($userID, '$dateFrom', '$dateTo', '$lang', $time, $rating, '$note')";

  if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $connection->error;
  }
  $connection->close();
}
header("Location:app.php");
?>