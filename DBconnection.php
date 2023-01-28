<?php
//DB variables

$database = 1; // 1 - server, 2 - local

if($database == 1){
    //server
    $DBservername = "mysql.hostify.cz";
    $DBusername = "db_28564_ProTrain";
    $DBpassword = "ProTrain2022";
    $db = "db_28564_ProTrain";
}elseif($database == 2){
    //local
    $DBservername = "localhost";
    $DBusername = "root";
    $DBpassword = "";
    $db = "apptestdb";
}






$connection = mysqli_connect($DBservername, $DBusername, $DBpassword, $db);

?>