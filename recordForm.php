<div class="records">
    <form action="recordValidation.php" method="post" class = "formRecord"> 
      <div class="labelinput">
          <div class="labels">
              <div class ="formlbl">Time(mins):</div>
              <div class="formlbl">Date From:</div>
              <div class="formlbl">Date To:</div>
              <div class="formlbl">Programming language:</div>
              <div class="formlbl">Rating:</div>
              <div class="formlbl">Note:</div>

          </div>
      
          <div class="inputs">
              <div class="formInp"><input class = "input" type="number" name="time" min="0" required></div>
              <div class="formInp"><input class = "input"  type="date" name="dateFrom" required></div>
              <div class="formInp"><input class = "input"  type="date" name="dateTo" required></div>
              <div class="formInp">
                <select class = "input"  name="jazyk" required>
                  <option value="C++">C++</option>
                  <option value="C">C</option>
                  <option value="C#">C#</option>
                  <option value="Python">Python</option>
                  <option value="HTML">HTML</option>
                  <option value="CSS">CSS</option>
                  <option value="SQL">SQL</option>
                  <option value="Rust">Rust</option>
                  <option value="JavaScript">JavaScript</option>
                </select>
              </div>
              <div class="formInp"><input class = "input"  type="number" name="rating" min="1" max="5" required></div>
              <div class="formInp"><textarea class = "input"  name="note" required></textarea></div>

          </div>
      </div>
      <div class="submitForm">
        <input type="submit" name="subInsert" class = "submit" value = "Submit" required>
      </div>
      
    </form>
    

<?php

if(isset($_POST["subInsert"])){
    echo "Váš záznam se odeslal";
}

?>
</div>