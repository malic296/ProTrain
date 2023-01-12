<?php 

include("DBconnection.php");

$DBuserID = $_SESSION["userID"];
$sql = "SELECT SUM(CasMin) as 'cas' FROM zaznamy WHERE ID_users = '$DBuserID';";
$result = $connection->query($sql);
$cas = $result->fetch_assoc();
$hours = round($cas["cas"] / 60, 2);


$sql = "SELECT ProgramJazyk as 'jazyk', count(ProgramJazyk) as pocet from zaznamy where ID_users = 27 group by ProgramJazyk HAVING pocet = (select max(programCount) as programMax from (select ProgramJazyk, COUNT(ProgramJazyk) as programCount from zaznamy where ID_users = 27 group by ProgramJazyk)t);";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        $learned[] = $row["jazyk"];
    }
}
else{
    
}



$sql = "SELECT AVG(Hodnoceni) as 'rating' from zaznamy WHERE ID_users = $DBuserID;";
$result = $connection->query($sql);
$rate = $result->fetch_assoc();
$rating = $rate["rating"];
$rating = round($rating, 2);

?>


<div class="dashboard">
    <div class="info1">

        <div class="info">
            <div class="infoTop">Total Time</div>
            <div class="infoCenter"><i class="fa-solid fa-clock"></i></div>
            <div class="infoBottom">
                <?php 
                    if($hours == 1){echo $hours . " Hour";}
                    else{echo $hours . " Hours";}                    
                ?>
            </div>
        </div>

        <div class="info">
            <div class="infoTop">Most Learned</div>
            <div class="infoCenter"><i class="fa-solid fa-code"></i></div>
            <div class="infoBottom">
                <?php 
                $pocet = count($learned); 
                $help = 0;
                while ($help < $pocet){
                    echo $learned[$help];
                    $help ++;
                    if($help == $pocet){
                        echo " ";
                    }
                    else{
                        echo ", ";
                    }
                }
                
                ?>
            </div>
        </div>

        <div class="info">
            <div class="infoTop">Average Rating</div>
            <div class="infoCenter"><i class="fa-solid fa-star"></i></div>
            <div class="infoBottom"><?php echo $rating;?></div>
        </div>

    </div>
    <div class="blanks">
        <div class="blank1"></div>
        <div class="blank2"></div>
    </div>
</div>

<?php
$connection->close();
?>