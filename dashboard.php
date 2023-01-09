<?php 
include("DBconnection.php");

$DBuserID = $_SESSION["userID"];
$sql = "SELECT SUM(CasMin) as 'cas' FROM zaznamy WHERE ID_users = '$DBuserID';";
$result = $connection->query($sql);
$cas = $result->fetch_assoc();
$hours = round($cas["cas"] / 60, 2);
$connection->close();

//include("DBconnection.php");
//$sql = "SELECT ProgramJazyk as 'jazyk' from zaznamy WHERE ID_users = $DBuserID GROUP BY ProgramJazyk ORDER BY COUNT(ProgramJazyk) DESC LIMIT 1;"
//$result = $connection->query($sql);
//$language = $result->fetch_assoc();
//$learned = $language["jazyk"];
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
            <div class="infoBottom"><?php //echo $learned; ?></div>
        </div>

        <div class="info">
            <div class="infoTop">Average Rating</div>
            <div class="infoCenter"><i class="fa-solid fa-star"></i></div>
            <div class="infoBottom">3</div>
        </div>

    </div>
    <div class="blanks">
        <div class="blank1"></div>
        <div class="blank2"></div>
    </div>
</div>

<?php
//$connection->close();
?>