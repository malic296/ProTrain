<?php
//DB variables
//server
/*
$DBservername = "mysql.hostify.cz";
$DBusername = "db_28564_ProTrain";
$DBpassword = "ProTrain2022";
$db = "db_28564_ProTrain";
*/
//local
$DBservername = "localhost";
$DBusername = "root";
$DBpassword = "";
$db = "apptestdb";
$connection = mysqli_connect($DBservername, $DBusername, $DBpassword, $db);

?>