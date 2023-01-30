<?php
session_start();
$id = $_SESSION["userID"];
if(isset($_POST['deleteProfile']) ) {

    include("DBconnection.php");

    $sql = mysqli_query($connection, "DELETE FROM kategorie WHERE ID_Users = '$id'");
    $sql = mysqli_query($connection, "DELETE FROM zaznamy WHERE ID_users = '$id'");
    $sql = mysqli_query($connection, "DELETE FROM users WHERE ID_users = '$id'");
    if ($sql) {  
        $connection->close();
        header('location:index.php');  
    }else{  
        echo "Error: ".mysqli_error($connection);  
    }  
  }
  
?>