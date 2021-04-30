
<html>
<body>


<?php

//database information
$servername = "";
$username = "";
$password = "";
$databaseName = "";

 $conn = new mysqli($servername,$username,$password,$databaseName);

$email = $_GET['email'];

echo $email;

// sql to delete a record with a given email
$sql = "DELETE FROM EMAILS WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

 


?>

</body>
</html>

