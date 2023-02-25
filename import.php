<?php
$cesta_k_souboru = 'user-files/zaznamy'.$_SESSION["userID"].'.csv';

include "DBconnection.php";
$index = 0;
$rows[$index] = ['ID_zaznamy','ID_users','ID_Kategorie','Datum','ProgramJazyk','CasMin','Hodnoceni','Poznamka'];
$sql = "SELECT * FROM zaznamy WHERE ID_users =". $_SESSION['userID'];
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $index++;
        $rows[$index] = [$row["ID_zaznamy"].",".$row["ID_users"].",".$row["ID_Kategorie"].",".$row["Datum"].",".$row["ProgramJazyk"].",".$row["CasMin"].",".$row["Hodnoceni"].",".$row["Poznamka"]];
    }
} 
else {
    $rows[1] = "Nemáte žádné záznamy";
}
$connection->close();


$path = 'user-files/zaznamy'.$_SESSION["userID"].'.csv';
$fp = fopen($path, 'w');
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
fclose($fp);
?>



<div class="import-export">
    <div class="export">

        <a class = "export-btn" href = '<?php echo $cesta_k_souboru; ?>' download>Export</a>

    </div>



    <div class="import">

        <form method = "post" class = "import-form">
            <input type="file" id="myFile" name="filename" required>
            <input type = "submit" value = "Odeslat" name = "upload">
        </form>

    </div>
</div>
