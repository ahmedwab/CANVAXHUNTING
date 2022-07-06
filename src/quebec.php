<?php


//database information
$servername = getenv('SERVERNAME');
$username = getenv('USERNAME');
$password = getenv('PASSWORD');
$databaseName = getenv('DATABASENAME');

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