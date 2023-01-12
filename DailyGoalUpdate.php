<?php
session_start();
include("DBconnection.php");

if(isset($_POST['updateGoal']))
{   

    $daily = $_POST['dailyGoal'];
    $id = $_SESSION["userID"];
    echo "$daily<br>";
    echo "$id<br>";

    $query = "UPDATE users SET dailyGoal='$daily' WHERE ID_users='$id'; ";
    $query_run = mysqli_query($connection, $query);
    
    if($query_run)
    {
        echo '<script> alert("Data Updated"); </script>';
        header("Location:app.php");
    }
    else
    {
        //echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>