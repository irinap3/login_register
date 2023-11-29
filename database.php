<?php

$hostName= "localhost";
$dbUser="root";
$dbPassword="";
$dbName="login_register";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword,$dbName);
 if($conn==false)
 {
    die("Ceva nu a mers bine.");
 }
?>