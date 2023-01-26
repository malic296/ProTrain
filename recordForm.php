<?php
include("DBconnection.php");
$DBuserID = $_SESSION["userID"];
$sql = "SELECT * from Kategorie WHERE ID_users = '$DBuserID';";
$result = $connection->query($sql);
$nameList = [];
$colorList = [];
$popisList = [];
$index = 0;
while ($row = $result->fetch_assoc()) {
    $idList[$index] = $row["ID_Kategorie"];
    $nameList[$index] = $row["nazev"];
    $colorList[$index] = $row["barva"];
    $popisList[$index] = $row["popis"];
    $index++;
}


?>


<div class="records">
    <form action="recordValidation.php" method="post" class = "formRecord"> 
      <div class="labelinput">
          <div class="double">
            <div class="labels">
                <div class ="formlbl">Time(mins):</div>

                <div class="formlbl">Programming language:</div>
                <div class="formlbl">Category:</div>

                <div class="formlbl">Rating<i class="fa-solid fa-star"></i>:</div>
                <div class="formlbl">Note:</div>

            </div>
            <div class="fill"></div>
        <?php 
          $languages = array("C++", "C", "C#", "Python", "HTML", "CSS", "SQL", "RUST", "JavaScript", "Ruby", "PHP");
        ?>
            <div class="inputs">
              
                <div class="formInp"><input class = "input" type="number" name="time" min="0" required></div>
                <div class="formInp">
                  <select class = "input"  name="jazyk" required>
                    <?php
                      foreach($languages as $lang){
                      echo "<option value='$lang'>$lang</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="formInp">
                  <select class = "input" name="category">
                      <?php 
                      foreach($nameList as $oneName){
                          $key = array_search($oneName, $nameList);

                          echo "<option value='$idList[$key]' style='color: $colorList[$key]'>$oneName</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="formInp"><input class = "input"  type="number" name="rating" min="1" max="5" required></div>
                <div class="formInp"><textarea class = "note"  name="note" required maxlength=255></textarea></div>
            </div>
          </div>

          <div class="submitForm">
            <input type="submit" name="subInsert" class = "submitFormButton" value = "Submit" required>
          </div>
      </div>
      
      
    </form>
    

<?php

$_SESSION["delete_alter"] = true;

?>
</div>