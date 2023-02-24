<form method = "post">
    <input type = "submit" value = "Download" name = "download">

</form>



<?php

if(isset($_POST["download"])){
    include "DBconnection.php";
    $sql = "SELECT * FROM zaznamy WHERE ID_users = 27";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        fopen("user".$_SESSION["userID"], "w");
        $file = fopen("user".$_SESSION["userID"], "w");
        fwrite($file,"ID Záznamu,ID Uživatele,ID Kategorie,Datum,Programovací Jazyk,Čas v minutách,Hodnocení,Poznámka".PHP_EOL);
        while($row = $result->fetch_assoc()) {
            fwrite($file, $row["ID_zaznamy"].",".$row["ID_users"].",".$row["ID_Kategorie"].",".$row["Datum"].",".$row["ProgramJazyk"].",".$row["CasMin"].",".$row["Hodnoceni"].",".$row["Poznamka"].PHP_EOL);
        }
        fclose($file);
    } 
    else {
        fopen("user".$_SESSION["userID"], "w");
        $file = fopen("user".$_SESSION["userID"], "w");
        fwrite($file,"Nemáte žádné záznamy");
        fclose($file);
    }
    $connection->close();
}
?>