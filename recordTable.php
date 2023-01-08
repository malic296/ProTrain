<div class="vysledky">
<?php

//printing from table zaznamy
include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
$sql = "select * from zaznamy where ID_users = $DBuserID "; //prikaz pro SQL
$result = $connection->query($sql);
echo "<table>";
echo "<tr class = 'zaznamy white top'><td class = 'first'>Date From</td><td>Date To</td><td class = 'small'>Language</td><td class = 'small'>Spent Time</td><td class = 'small'>Rating</td><td>Note</td><td class = 'last'></td></tr>";
$help = 1;
if ($result->num_rows > 0) {
 
  while ($row = $result->fetch_assoc()) {
    $DBzaznamID = $row["ID_zaznamy"];
    if($help % 2 == 1){echo "<tr class = 'zaznamy grey'>";}
    else{echo "<tr class = 'zaznamy white'>";}
    $help ++;
    echo "  <td class = 'first'>".$row["DatumOD"]."</td> 

            <td>".$row["DatumDO"]."</td> 

            <td class = 'small'>".$row["ProgramJazyk"]."</td> 

            <td class = 'small'>".$row["CasMin"]."</td> 

            <td class = 'small'>".$row["Hodnoceni"]."</td> 
            
            <td>".$row["Poznamka"]."</td>". 

            "<td class = 'last'><a href='recordDelete.php?id=$DBzaznamID' class='delete'>Delete</a>
            <a href='recordAlter.php?id=$DBzaznamID' class='alter'>Edit</a></td>
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