<?php
session_start();
include("DBconnection.php");

if(isset($_POST['addCategorySubmit']))
{   
    $id = $_SESSION["userID"];
    $nameCategory = $_POST['nameCategory'];
    $colorCategory = $_POST['colorCategory'];
    $descriptionCategory = $_POST['descriptionCategory'];



    $query = "INSERT INTO Kategorie (ID_Users, nazev, barva, popis) VALUES ($id, '$nameCategory', '$colorCategory', '$descriptionCategory'); ";
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