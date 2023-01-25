<?php
include("DBconnection.php");
$sql = "select * from zaznamy where ID_users = $DBuserID ORDER by ID_zaznamy DESC limit 5";
$result = $connection->query($sql);


//
$date = date('Y-m-d');
$newSql = "SELECT sum(CasMin) as cas FROM `zaznamy` WHERE Datum = '$date' and ID_users = $DBuserID;";
$newResult = $connection->query($newSql);
$newResult = $newResult->fetch_assoc();
$cas = $newResult["cas"]
?>

<div class='content2'>
    <div class='goal1'>
        <h1>Daily Goal</h1>
        <div class="circular-progress">
    <span class="progress-value">0%</span>
</div>

    <?php
    $dayGoal = $DBDailyGoal;
    $minutes = $cas;
    if($dayGoal > 0){
        $cislo = ($minutes / $dayGoal) * 100;
        $cislo = round($cislo);
    }else{
        $cislo = 100;
    }
    
    ?>

    
    </div>
    <h3>Latest records</h3>
    <div class='goal2'>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $DBzaznamID = $row["ID_zaznamy"];
                echo "<div class='lastRow'> <div class='textRowOne'>" . $row["ProgramJazyk"] . "<i class='fa-solid fa-code'></i></div><div class='textRowTwo'> " . $row["CasMin"] . "<i class='fa-solid fa-clock'></div><div class='textRowThree'></i> " . $row["Hodnoceni"] . "<i class='fa-solid fa-star'></i></div></div>";

            }
        }else{
            echo "You don't have any records";
        }
        ?>
    </div>
    
</div>
<script>
    let circularProgress = document.querySelector(".circular-progress"),
        progressValue = document.querySelector(".progress-value");

    let progressStartValue = 0,    
        progressEndValue = <?php echo $cislo; ?>,    
        speed = 20;

    let progress = setInterval(() => {
        progressValue.textContent = `${progressStartValue}%`
        circularProgress.style.background = `conic-gradient(#51c7a4 ${progressStartValue * 3.6}deg, #ededed 0deg)`
        if(progressStartValue == progressEndValue){
            clearInterval(progress);
        }    
        if (progress != 0){
        progressStartValue++;
        }   
    }, speed);
</script>