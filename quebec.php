<?php


//database information
$servername = "mysql.canvaxsearch.com";
$username = "canvaxadmin";
$password = "Cvs14072510";
$databaseName = "canvaxdb";

$conn = new mysqli($servername, $username, $password, $databaseName);


$sql = "UPDATE tweet
SET cities = \"{'Montreal'}\"
WHERE Province ='QC' AND cities = \"{'Montréal'}\"";

$stmt = $conn->prepare($sql);
$stmt->execute();

echo "changed montreal names";

$conn->close;
$stmt->close;

?>