<?php
session_start();
error_reporting(0);

//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";

$conn = new mysqli($servername,$username,$password,$databaseName);


$password= $_POST['update-password'];


$SQL = $db_found->prepare("UPDATE ACCOUNTS SET password=?,WHERE email=?");

$SQL->bind_param('ss', $password, $email);
$password = MD5('$password');
$email=  $_POST['update-email'];
$SQL->execute();

$_SESSION["user"] = $username;
header('Location: login.php');

$stmt->close();
$conn->close();
?>