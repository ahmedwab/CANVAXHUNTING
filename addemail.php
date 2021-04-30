
<html>
<body>

<h1> User Side </h1>
<h2> Want to know when a vaccine is available near you?Input the following info:</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Email: <input type="text" name="email"><br>
  Postal Code: <input type="text" name="pcode" maxlength="3"><br>
  <input type="submit">
</form>

<?php

//database information
$servername = "";
$username = "";
$password = "";
$databaseName = "";

 $conn = new mysqli($servername,$username,$password,$databaseName);



 

  //if a post request is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input fields
  $email = $_POST['email'];
  $postalCode = $_POST['pcode'];

    //check if fields are properly inputted
  if (!(empty($email)||strlen($postalCode)!=3)){

    //Input Email information in EMAILS table

  $sql = "INSERT INTO EMAILS (EMAIL, POSTALCODE)
VALUES ('$email', '$postalCode')";
  }


if (mysqli_query($conn, $sql)) {
  echo "New record created successfully<br>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}
  }


?>

</body>
</html>

