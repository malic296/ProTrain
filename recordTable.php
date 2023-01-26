<?php 
include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

$DBuserID = $_SESSION["userID"];
$sql = "SELECT * from Kategorie WHERE ID_users = '$DBuserID';";
$result = $connection->query($sql);
$nameList = [];
$colorList = [];
$popisList = [];
$idList = [];
$index = 0;
while ($row = $result->fetch_assoc()) {
    $idList[$index] = $row["ID_Kategorie"];
    $nameList[$index] = $row["nazev"];
    $colorList[$index] = $row["barva"];
    $popisList[$index] = $row["popis"];
    $index++;
}


$sql = "SELECT DISTINCT ProgramJazyk from zaznamy where ID_users = $DBuserID";
$run = mysqli_query($connection, $sql);

$languages = array("C++", "C", "C#", "Python", "HTML", "CSS", "SQL", "RUST", "JavaScript", "Ruby", "PHP");



?>


<div class="filtrace">
    <form method="POST" action="">
        
        <?php
        if (mysqli_num_rows($run) > 0) {
            ?>
                <div class="headerFilter">Filter by language</div>
                <?php
                foreach ($run as $jazykList) {
                    $checked = [];
                    if (isset($_POST["languages"])) {
                        $checked = $_POST["languages"];
                    }

                    ?>

                    <div>
                        <input type="checkbox" name="languages[]" value="<?= $jazykList["ProgramJazyk"]; ?>"
                            <?php if (in_array($jazykList["ProgramJazyk"], $checked)) {
                                echo "checked";
                            } ?>
                        />
                        <?= $jazykList["ProgramJazyk"]; ?>
                    </div>    
                    <?php
                }
                ?>
                
                <?php
                $sql = "SELECT DISTINCT nazev from kategorie where ID_users = $DBuserID";
                $run = mysqli_query($connection, $sql);
                if (mysqli_num_rows($run) > 0) {
                    ?><div class=""headerFilter>Filter by category</div>
                    <?php
                    foreach ($run as $categoryList) {
                        $checkedCategory = [];
                        if (isset($_POST["categories"])) {
                            $checkedCategory = $_POST["categories"];
                        }

                        ?>
    
                        <div>
                            <input type="checkbox" name="categories[]" value="<?= $categoryList["nazev"]; ?>"
                                <?php if (in_array($categoryList["nazev"], $checkedCategory)) {
                                    echo "checked";
                                } ?>
                            />
                            <?= $categoryList["nazev"]; ?>
                        </div>    
                        <?php
                    }
                }
        }
                    ?>

        <div class="headerFilter">Filter by date</div>               
                <div>
                    <input type="date" name="filterDateFrom" class="inputFilter" <?php if(isset($_POST["filterDateFrom"])){$dateFrom = $_POST["filterDateFrom"]; echo" value='$dateFrom'"; } ?> > From
                </div>
                <div>
                    <input type="date" name="filterDateTo" class="inputFilter" <?php if(isset($_POST["filterDateTo"])){$dateTo = $_POST["filterDateTo"]; echo" value='$dateTo'"; } ?> > To
                </div>
                <div class="headerFilter">Filter by rating</div>
                <div>
                    <input type="number" name="ratingFrom" class="inputFilter" min="1" max="5" <?php if(isset($_POST["ratingFrom"])){$ratingFrom = $_POST["ratingFrom"]; echo" value='$ratingFrom'"; } ?> > From
                </div>
                <div>
                    <input type="number" name="ratingTo" class="inputFilter" min="1" max="5" <?php if(isset($_POST["ratingTo"])){$ratingTo = $_POST["ratingTo"]; echo" value='$ratingTo'"; } ?> > To
                </div>
                <div class="headerFilter">Filter by time</div>
                <div>
                    <input type="number" name="timeFrom" class="inputFilter" min="1"  <?php if(isset($_POST["timeFrom"])){$timeFrom = $_POST["timeFrom"]; echo" value='$timeFrom'"; } ?> > From   
                </div>
                <div>
                    <input type="number" name="timeTo" class="inputFilter" min="0" <?php if(isset($_POST["timeTo"])){$timeTo = $_POST["timeTo"]; echo" value='$timeTo'"; } ?> > To
                </div>
        <br>
        <input type = "submit" class = "submitFilter" name = "filter" value = "Filter">
    </form>
</div>
<div class="vysledky">   

<?php

//printing from table zaznamy
if(isset($_POST["languages"])){
    $langChecked = [];
    $langChecked = $_POST["languages"];
    echo "<table>";
    echo "<tr class = 'zaznamy top'><td class = 'first'>id</td><td class = 'small'><b><i class='fa-solid fa-calendar'></i>Category</b></td><td class = 'small'><b><i class='fa-solid fa-calendar'></i>Date</b></td><td class = 'small'><b><i class='fa-solid fa-code'></i>Language</b></td><td class = 'small'><b><i class='fa-solid fa-clock'></i>Spent Time</b></td><td class = 'small'><b><i class='fa-solid fa-star'></i>Rating</b></td><td><b><i class='fa-solid fa-comment-dots'></i>Note</b></td><td class = 'last'><b><i class='fa-solid fa-wrench'></i>Actions</b></td'></tr>";
    foreach($langChecked as $oneLang){
        if (isset($_POST["filterDateFrom"]) and isset($_POST["filterDateTo"])){
            $dateFrom = $_POST["filterDateFrom"];
            $dateTo = $_POST["filterDateTo"];
            if($dateFrom != "" and $dateTo != ""){
                $sql = "SELECT * from zaznamy where ID_users = $DBuserID and Datum BETWEEN '$dateFrom' and '$dateTo' and ProgramJazyk IN ('$oneLang')";
            }elseif($dateFrom != ""){
                $sql = "SELECT * from zaznamy where ID_users = $DBuserID and Datum >= '$dateFrom' and ProgramJazyk IN ('$oneLang')";
            }elseif($dateTo != ""){
                $sql = "SELECT * from zaznamy where ID_users = $DBuserID and Datum <= '$dateTo' and ProgramJazyk IN ('$oneLang')";
            }else{
                $sql = "SELECT * from zaznamy where ID_users = $DBuserID and ProgramJazyk IN ('$oneLang')";
            }  
        }
        if(isset($_POST["ratingFrom"]) or (isset($_POST["ratingTo"]))){
            $ratingFrom = $_POST["ratingFrom"];
            $ratingTo = $_POST["ratingTo"];
            if($ratingFrom != "" and $ratingTo != ""){
                $sql = $sql . " AND Hodnoceni BETWEEN $ratingFrom and $ratingTo";
            }elseif($ratingFrom != ""){
                $sql = $sql . " AND Hodnoceni > $ratingFrom";
            }elseif($ratingTo != ""){
                $sql = $sql . " AND Hodnoceni < $ratingTo";
            } 
        }

        if(isset($_POST["timeFrom"]) or (isset($_POST["timeTo"]))){
            $timeFrom = $_POST["timeFrom"];
            $timeTo = $_POST["timeTo"];
            if($timeFrom != "" and $timeTo != ""){
                $sql = $sql . " AND CasMin BETWEEN $timeFrom and $timeTo";
            }elseif($timeFrom != ""){
                $sql = $sql . " AND CasMin > $timeFrom";
            }elseif($timeTo != ""){
                $sql = $sql . " AND CasMin < $timeTo";
            } 
        }
        if (isset($_POST["categories"])) {
            $filterCategory = [];
            $filterCategory = $_POST["categories"];
            $IDfilterCategory = [];
            $index = 0;
            foreach ($filterCategory as $oneCategory) {
                $key = array_search($oneCategory, $nameList);
                $IDfilterCategory[$index] = $idList[$key];
                $index++;    
            }
            foreach ($IDfilterCategory as $oneID) {
                $sql = $sql . " AND ID_Kategorie IN ('$oneID')";
            }
        }
        $result = $connection->query($sql);
        while ($row = $result->fetch_assoc()) {
            $DBzaznamID = $row["ID_zaznamy"];
    
            if(strlen($row["Poznamka"]) > 5) {
                $shortcut = substr($row["Poznamka"], 0, 5) . "<form action = 'showNote.php' method='post'><button name = 'threeDots' type = 'submit' class = 'noteShow' value = '".$row['Poznamka']."'>...</button></form>";
            }
            else{
                $shortcut = $row["Poznamka"];
            }  

            $ID_Kategorie = $row["ID_Kategorie"];
            $key = array_search($ID_Kategorie, $idList);
            if($ID_Kategorie != ""){
                $tableCategory = $nameList[$key];
            }else{
                $tableCategory = $row["ID_Kategorie"];
            }
            
            echo "<tr class = 'zaznamy tableRow'>";
            echo "  <td class = 'first'>".$row["ID_zaznamy"]."</td> 


                    <td class = 'small'>".$tableCategory."</td>                                         
                    

                    <td class = 'small'>".$row["Datum"]."</td> 
                    <td class = 'small'>".$row["ProgramJazyk"]."</td> 
                    <td class = 'small'>".$row["CasMin"]."</td> 
                    <td class = 'small'>".$row["Hodnoceni"]."</td> 
                    
                    <td>".$shortcut."</td>". 
    
                    "<td class='btns'>
                    <a href='recordDelete.php?id=$DBzaznamID' class='delete'>Delete</a> 
                    <button type='button' class='alter' id=$DBzaznamID data-toggle='modal' data-target='#studentaddmodal'>Edit</button>
                    
                    </td>
                </tr>";
        }
    }
    
}else{
    if (isset($_POST["filterDateFrom"]) and isset($_POST["filterDateTo"])){
        $dateFrom = $_POST["filterDateFrom"];
        $dateTo = $_POST["filterDateTo"];
        $sql = "SELECT * from zaznamy where ID_users = $DBuserID";
        if($dateFrom != "" and $dateTo != ""){
            $sql = $sql . " and Datum BETWEEN '$dateFrom' and '$dateTo'";
        }elseif($dateFrom != ""){
            $sql = " and Datum >= '$dateFrom'";
        }elseif($dateTo != ""){
            $sql = $sql . " and Datum <= '$dateTo'";
        }else{
            $sql = "SELECT * from zaznamy where ID_users = $DBuserID ";
        }
    }else{
        $sql = "SELECT * from zaznamy where ID_users = $DBuserID ";
    }
    if(isset($_POST["ratingFrom"]) or (isset($_POST["ratingTo"]))){
        $ratingFrom = $_POST["ratingFrom"];
        $ratingTo = $_POST["ratingTo"];
        if($ratingFrom != "" and $ratingTo != ""){
            $sql = $sql . " AND Hodnoceni BETWEEN $ratingFrom and $ratingTo";
        }elseif($ratingFrom != ""){
            $sql = $sql . " AND Hodnoceni > $ratingFrom";
        }elseif($ratingTo != ""){
            $sql = $sql . " AND Hodnoceni < $ratingTo";
        } 
    }
    if(isset($_POST["timeFrom"]) or (isset($_POST["timeTo"]))){
        $timeFrom = $_POST["timeFrom"];
        $timeTo = $_POST["timeTo"];
        if($timeFrom != "" and $timeTo != ""){
            $sql = $sql . " AND CasMin BETWEEN $timeFrom and $timeTo";
        }elseif($timeFrom != ""){
            $sql = $sql . " AND CasMin > $timeFrom";
        }elseif($timeTo != ""){
            $sql = $sql . " AND CasMin < $timeTo";
        } 
    }
    if (isset($_POST["categories"])) {
        $filterCategory = [];
        $filterCategory = $_POST["categories"];
        $IDfilterCategory = [];
        $index = 0;
        
        foreach ($filterCategory as $oneCategory) {
            $key = array_search($oneCategory, $nameList);
            $IDfilterCategory[$index] = $idList[$key];
            $index++;    
        }
        foreach ($IDfilterCategory as $oneID) {
            $sql = $sql . " AND ID_Kategorie IN ('$oneID')";
        }
    }
    $result = $connection->query($sql);
    echo "<table>";
    echo "<tr class = 'zaznamy top'><td class = 'first'>id</td><td class = 'small'><b><i class='fa-solid fa-calendar'></i>Category</b></td><td class = 'small'><b><i class='fa-solid fa-calendar'></i>Date</b></td><td class = 'small'><b><i class='fa-solid fa-code'></i>Language</b></td><td class = 'small'><b><i class='fa-solid fa-clock'></i>Spent Time</b></td><td class = 'small'><b><i class='fa-solid fa-star'></i>Rating</b></td><td><b><i class='fa-solid fa-comment-dots'></i>Note</b></td><td class = 'last'><b><i class='fa-solid fa-wrench'></i>Actions</b></td'></tr>";

    if ($result->num_rows > 0) {
        
    while ($row = $result->fetch_assoc()) {
        $DBzaznamID = $row["ID_zaznamy"];

        if(strlen($row["Poznamka"]) > 5) {
            $shortcut = substr($row["Poznamka"], 0, 5) . "<form action = 'showNote.php' method='post'><button name = 'threeDots' type = 'submit' class = 'noteShow' value = '".$row['Poznamka']."'>...</button></form>";
        }
        else{
            $shortcut = $row["Poznamka"];
        }   

        $ID_Kategorie = $row["ID_Kategorie"];
            if(count($idList) != 0){
                $key = array_search($ID_Kategorie, $idList);
            }
            
            if($ID_Kategorie != ""){
                $tableCategory = $nameList[$key];
            }else{
                $tableCategory = $row["ID_Kategorie"];
            }

        echo "<tr class = 'zaznamy tableRow'>";
        echo "  <td class = 'first'>".$row["ID_zaznamy"]."</td> 
                <td class = 'small'>".$tableCategory."</td>    
                <td class = 'small'>".$row["Datum"]."</td> 
                <td class = 'small'>".$row["ProgramJazyk"]."</td> 
                <td class = 'small'>".$row["CasMin"]."</td> 
                <td class = 'small'>".$row["Hodnoceni"]."</td> 
                
                <td>".$shortcut."</td>". 

                "<td class='btns'>
                <a href='recordDelete.php?id=$DBzaznamID' class='delete'>Delete</a> 
                <button type='button' class='alter' id=$DBzaznamID data-toggle='modal' data-target='#studentaddmodal'>Edit</button>
                
                </td>
            </tr>";
    }
    } else {
    echo "You don't have any records";
    }
}
// Co uvidí user
echo "</table>";
$connection->close();

?>
    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit data </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="recordUpdate.php" method="POST">

                    <div class="modal-body">
                        <input class = "input" type="hidden" name="recordID" id="ID_zaznamy">
                        
                        <div class="modalPart">
                            <label> Category</label>
                            <select class = "input" type="t" name="category" id="Category" class="">
                                <?php 
                                    foreach($nameList as $oneName){
                                        $key = array_search($oneName, $nameList);
                                        echo "<option value='$idList[$key]' style='color: $colorList[$key]'>$oneName</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="modalPart">
                            <label> Date</label>
                            <input  class = "input" type="date" name="date" id="Datum" class="" placeholder="Enter date">
                        </div>

                        <div class="modalPart">
                            <label> Language </label>
                            <select  class = "input" name="language" id="ProgramJazyk" class="" placeholder="Select language">
                              <?php                                                         
                                  foreach($languages as $lang){
                                  echo "<option value='$lang'>$lang</option>";
                                  }                                                          
                                ?>
                          </select>
                        </div>

                        <div class="modalPart">
                            <label> Spent Time </label>
                            <input  class = "input" type="number" name="spentTime" id="CasMin" class="" placeholder="Enter time">
                        </div>

                        <div class="modalPart">
                            <label> Rating </label>
                            <input  class = "input" type="number" name="rating" id="Hodnoceni" class="" placeholder="Enter rating">
                        </div>

                        <div class="modalPart">
                            <label> Note </label>
                            <input  class = "input" type="text" name="note" id="Poznamka" class="" placeholder="Write note">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="submitProf" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="submitProf">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.alter').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#ID_zaznamy').val(data[0]);
                $('#Category').val(data[1]);
                $('#Datum').val(data[2]);
                $('#ProgramJazyk').val(data[3]);
                $('#CasMin').val(data[4]);
                $('#Hodnoceni').val(data[5]);
                $('#Poznamka').val(data[6]);
            });
        });
    </script>

