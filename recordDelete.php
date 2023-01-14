<?php
session_start();
//deleting from table zaznamy
$_SESSION["delete_alter"] = true;
if(isset($_GET['id']) ) {
    $id = $_GET['id'];

    include("DBconnection.php");

    $sql = mysqli_query($connection, "DELETE FROM zaznamy WHERE ID_zaznamy = '$id'");
    if ($sql) {  
        $connection->close();
        header('location:app.php');  
    }else{  
        echo "Error: ".mysqli_error($connection);  
    }  
  }
  
?>