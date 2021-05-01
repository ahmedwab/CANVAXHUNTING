
<html>
<body>


<?php

//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";

 $conn = new mysqli($servername,$username,$password,$databaseName);

$email = $_GET['email'];


// sql to delete a record with a given email
$sql = "DELETE FROM EMAILS WHERE email='$email'";

if ($conn->query($sql) === TRUE && $email !=NULL) {
  echo $email . ' has been unsubscribed.';
} else {
  echo "Email is not subscribed";
}

 


?>

</body>
</html>

