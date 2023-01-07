<div class="records seen">
  <form action="recordValidation.php" method="post" class = "formRecord"> 
    <label for = "time">Čas v minutách:</label><br> <input class = "input" type="number" name="time" min="0" required><br><br>
    <label for = "dateFrom">Datum Od:</label><br> <input class = "input"  type="date" name="dateFrom" required><br><br>
    <label for = "dateTo">Datum Do:</label><br> <input class = "input"  type="date" name="dateTo" required><br><br>
    <label for = "jazyk">Programovací jazyk: </label><br> <select class = "input"  name="jazyk" required>
      <option value="C++">C++</option>
      <option value="C">C</option>
      <option value="C#">C#</option>
      <option value="Python">Python</option>
      <option value="HTML">HTML</option>
      <option value="CSS">CSS</option>
      <option value="SQL">SQL</option>
      <option value="Rust">Rust</option>
      <option value="JavaScript">JavaScript</option>
    </select><br><br>
    <label for = "rating">Hodnocení: </label><br> <input class = "input"  type="number" name="rating" min="1" max="5" required><br><br>
    <label for = "note">Poznámka:</label><br> <textarea class = "input"  name="note" required></textarea><br>
    <input type="submit" name="subInsert" class = "delete_alter" required>
</form>
<?php

if(isset($_POST["subInsert"])){
    echo "Váš záznam se odeslal";
}

?>
</div>