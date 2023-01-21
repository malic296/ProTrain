<?php 

include("DBconnection.php");

$DBuserID = $_SESSION["userID"];
$sql = "SELECT SUM(CasMin) as 'cas' FROM zaznamy WHERE ID_users = '$DBuserID';";
$result = $connection->query($sql);
$cas = $result->fetch_assoc();
$hours = round($cas["cas"] / 60, 2);
$mins = $cas["cas"];

$sql = "SELECT ProgramJazyk as 'jazyk', count(ProgramJazyk) as pocet from zaznamy where ID_users = '$DBuserID' group by ProgramJazyk HAVING pocet = (select max(programCount) as programMax from (select ProgramJazyk, COUNT(ProgramJazyk) as programCount from zaznamy where ID_users = '$DBuserID' group by ProgramJazyk)t);";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        $learned[] = $row["jazyk"];
    }
}
else{
    $learned[] = "None";
}

$sql = "SELECT AVG(Hodnoceni) as 'rating' from zaznamy WHERE ID_users = $DBuserID;";
$result = $connection->query($sql);
$rate = $result->fetch_assoc();
$rating = $rate["rating"];
$rating = round($rating, 2);

//charts
$sql = "SELECT count(ProgramJazyk) as languageCount, ProgramJazyk FROM `zaznamy` WHERE ID_users = $DBuserID GROUP BY ProgramJazyk";
$result = $connection->query($sql);
$langList = [];
$langCountList = [];
$index = 0;
while ($row = $result->fetch_assoc()) {
    $langList[$index] = $row["ProgramJazyk"];
    $langCountList[$index] = $row["languageCount"];
    $index++;
}

$currentYear = date("Y");
$sql = "SELECT count(ProgramJazyk) as pocet, month(Datum) from zaznamy WHERE ID_users = $DBuserID and year(Datum) = $currentYear GROUP BY month(Datum)";
$result = $connection->query($sql);
$monthsData = [];

$index = 0;
while ($row = $result->fetch_assoc()) {
    $monthsData[$index] = $row["pocet"];
    $index++;
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="dashboard">
    <div class="info1">

        <div class="info">
            <div class="infoTop">Total Time</div>
            <div class="infoCenter"><i class="fa-solid fa-clock"></i></div>
            <div class="infoBottom">
                <?php 
                    if($hours < 1){
                        if ($mins == 1){
                            echo $mins . " Min";
                        }else{
                            echo $mins . " Mins";

                        }
                    }else{
                        if($hours == 1){echo $hours . " Hour";}
                    else{echo $hours . " Hours";}
                    }
                                      
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
        <div class="blank1" id="radar-chart" style="width:35%;">
            <canvas id="radarChart" style="width:90%; margin: auto; margin-top: 20%;"></canvas>
        </div> <!-- radar chart -->
        <div class="blank2" id="bar-chart" style="width:65%">
            <canvas id="barChart" style="width:90%; margin: auto; margin-top: 30%;"></canvas>
        </div> <!-- bar chart -->
    </div>
    
    <script>
    const radarChartDest = document.getElementById('radarChart');
    const radarChartData = {
    labels: <?php echo json_encode($langList); ?>,
    datasets: [{
        label:"Number of lessons",
        data: <?php echo json_encode($langCountList); ?>,
        fill: true,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgb(255, 99, 132)',
        pointBackgroundColor: 'rgb(255, 99, 132)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(255, 99, 132)'
    }]
    };
    new Chart(radarChartDest, {
    type: 'radar',
    data: radarChartData,
    options: {
        elements: {
        line: {
            borderWidth: 3
        },
        }
    },
    });
    </script>
    <script>
        const ctx = document.getElementById('barChart');
        const months = ['January','February','March','April','May','June','July','August','September','October','November','December']
        new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'My First Dataset',
                data: <?php echo json_encode($monthsData); ?>,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
        });
    </script>
</div>




<?php
$connection->close();
?>