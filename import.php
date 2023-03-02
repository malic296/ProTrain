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

        <form method = "post" class = "import-form" enctype="multipart/form-data">
            <input type="file" id="file" name="file" required>
            <input type = "submit" value = "Odeslat" name = "upload">
        </form>

    </div>
</div>

<?php
if(isset($_POST["upload"])){
    include("DBconnection.php");
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $dataString = $line[0];
                $dataList = explode(",", $dataString);
                if($dataList[2] != ""){
                    $sql = "INSERT INTO zaznamy (ID_users, ID_Kategorie, Datum, ProgramJazyk, CasMin, Hodnoceni, Poznamka) VALUES ($dataList[1], $dataList[2], '$dataList[3]', '$dataList[4]', $dataList[5], '$dataList[6]', '$dataList[7]')";
                }else{
                    $sql = "INSERT INTO zaznamy (ID_users, Datum, ProgramJazyk, CasMin, Hodnoceni, Poznamka) VALUES ($dataList[1], '$dataList[3]', '$dataList[4]', $dataList[5], '$dataList[6]', '$dataList[7]')";
                }
                
                if ($connection->query($sql) === TRUE) {
                   
                  } else {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                  }
      
            }
        }
    }
    header("Location:app.php");
}

?>