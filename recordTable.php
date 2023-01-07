<div class="vysledky seen">
<?php

//printing from table zaznamy
echo "<span class = 'recs'>Vaše Záznamy</span><br>";
include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
$sql = "select * from zaznamy where ID_users = $DBuserID "; //prikaz pro SQL
$result = $connection->query($sql);
echo "<table class>";
echo "<tr class = 'hlavicka'> <th>Datum od</th> <th>Datum do</th> <th>Programovaci jazyk</th> <th>Cas</th> <th>Hodnoceni</th> <th>Poznamka</th> </tr>";
if ($result->num_rows > 0) {
 
  while ($row = $result->fetch_assoc()) {
    $DBzaznamID = $row["ID_zaznamy"];
    echo "<tr class = 'zaznamy'> 
            <td>".$row["DatumOD"]."</td> 
            <td>".$row["DatumDO"]."</td> 
            <td>".$row["ProgramJazyk"]."</td> 
            <td>".$row["CasMin"]."</td> 
            <td>".$row["Hodnoceni"]."</td> 
            <td>".$row["Poznamka"]."</td>" . 
            "<td class = 'buttons'><a href='recordDelete.php?id=$DBzaznamID' class='delete_alter'>Delete</a>
            <a href='recordAlter.php?id=$DBzaznamID' class='delete_alter'>Alter</a></td>
          </tr>";
  }
} else {
  echo "Nemáte žádné záznamy";
}
// Co uvidí user



echo "</table>";
$connection->close();

?>
</div>