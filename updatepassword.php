<?php
session_start();
error_reporting(0);

//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";

$conn = new mysqli($servername,$username,$password,$databaseName);

$email=  $_POST['update-email'];
$password= $_POST['update-password'];

$sql = "UPDATE ACCOUNTS SET password=MD5('$password') WHERE EMAIL='$email'";


$conn->query($sql);
$_SESSION["user"] = $username;
header('Location: login.php');


$conn->close();
?>