<?php
include("DBconnection.php");
$sql = "select * from zaznamy where ID_users = $DBuserID ORDER by ID_zaznamy DESC limit 5";
$result = $connection->query($sql);



?>

<div class='content2'>
    <div class='goal1'><h1>Daily Goal</h1><br>circle</div>
    <div class='goal2'>
        <h3>Latest records</h3>
        <?php
            
            while ($row = $result->fetch_assoc()) {
                $DBzaznamID = $row["ID_zaznamy"];
                echo "<div class='lastRow'>".$row["ProgramJazyk"]."<i class='fa-solid fa-code'></i> ".$row["CasMin"]."<i class='fa-solid fa-clock'></i> ".$row["Hodnoceni"]."<i class='fa-solid fa-star'></i></div>";
                
            }

        ?>
    </div>
    
</div>
