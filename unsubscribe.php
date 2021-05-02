
<html>
<body>


<?php

//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";

 $conn = new mysqli($servername,$username,$password,$databaseName);




$sql = $conn->prepare("DELETE FROM members WHERE email=?");
$sql->bind_param('s', $email);
$email = $_GET['email'];

if ($SQL->execute() == TRUE && $email !=NULL) {
  echo $email . ' has been unsubscribed.';
} else {
  echo "Email is not subscribed";
}

 

$stmt->close();
$conn->close();
?>

</body>
</html>

