<?php
include("DBconnection.php");

if(isset($_POST['updatedata']))
{   
    $rawDate = htmlentities($_POST['date']);
    $date = date('Y-m-d', strtotime($rawDate));
    $id = $_POST['recordID'];
    $language = $_POST['language'];
    $spentTime = $_POST['spentTime'];
    $rating = $_POST['rating'];
    $note = $_POST['note'];

    $query = "UPDATE zaznamy SET Datum='$date', ProgramJazyk='$language', CasMin='$spentTime', Hodnoceni='$rating', Poznamka=' $note' WHERE ID_zaznamy='$id'; ";
    $query_run = mysqli_query($connection, $query);
    
    if($query_run)
    {
        echo '<script> alert("Data Updated"); </script>';
        header("Location:app.php");
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>