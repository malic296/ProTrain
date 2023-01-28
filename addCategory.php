<?php
session_start();
include("DBconnection.php");


if(isset($_POST['addCategorySubmit']))
{   
    $id = $_SESSION["userID"];
    $nameCategory = $_POST['nameCategory'];
    $colorCategory = $_POST['colorCategory'];
    $descriptionCategory = $_POST['descriptionCategory'];



    $query = "INSERT INTO kategorie (ID_Users, nazev, barva, popis) VALUES ($id, '$nameCategory', '$colorCategory', '$descriptionCategory'); ";
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
} elseif (isset($_POST['addCategoryDelete'])) {$DBuserID = $_SESSION["userID"];
    $id = $_SESSION["userID"];
    $nameCategory = $_POST['deleteCategory'];
    $sql = "SELECT * from kategorie WHERE ID_users = '$DBuserID';";
    $result = $connection->query($sql);

    $idList = [];
    $nameList = [];
    $colorList = [];
    $popisList = [];
    $index = 0;
    while ($row = $result->fetch_assoc()) {
        $idList[$index] = $row["ID_Kategorie"];
        $nameList[$index] = $row["nazev"];
        $colorList[$index] = $row["barva"];
        $popisList[$index] = $row["popis"];
        $index++;
    }
    $key = array_search($nameCategory, $nameList);
    $idCategory = $idList[$key];

    $sql = mysqli_query($connection, "UPDATE zaznamy SET ID_Kategorie = NULL where ID_Kategorie = '$idCategory'");
    $sql = mysqli_query($connection, "DELETE FROM kategorie WHERE ID_Kategorie = '$idCategory'");
    header("Location:app.php");
}
?>