<div class="records">
    <form action="recordValidation.php" method="post" class = "formRecord"> 
      <div class="labelinput">
          <div class="double">
            <div class="labels">
                <div class ="formlbl">Time(mins):</div>

                <div class="formlbl">Programming language:</div>
                <div class="formlbl">my language:</div>
                <div class="formlbl">Rating<i class="fa-solid fa-star"></i>:</div>
                <div class="formlbl">Note:</div>

            </div>
            <div class="fill"></div>
        <?php 
          $languages = array("C++", "C", "C#", "Python", "HTML", "CSS", "SQL", "RUST", "JavaScript", "Ruby");
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
                <div class="formInp"><input class = "input"  type="text" name="langElse"></div>
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