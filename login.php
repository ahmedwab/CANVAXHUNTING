<?php
session_start();
error_reporting(0);

//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";

 $conn = new mysqli($servername,$username,$password,$databaseName);


 $accountusername= $accountpassword = '';


 if(isset($_POST['submit-login']))
{

 $accountusername=$_POST['login-username'];
 $accountpassword=$_POST['login-password'];


 $sql = "SELECT EMAIL,password FROM ACCOUNTS WHERE EMAIL='$accountusername' AND PASSWORD=MD5('$accountpassword') LIMIT 1" ;
 $result = $conn->query($sql);


if ($result -> num_rows > 0){
   while($row = $result->fetch_assoc()){
     $_SESSION["user"] = $accountusername;
   }
   header('Location: addposts.php');

 }
else{
  echo "<script> alert('Invalid Username and Password combination'".$accountpassword.") </script>";

}
}
$forgotusername=$_POST['forgot-username'];
if(isset($_POST['submit-pass'])){
$sql = "SELECT lower(username) WHERE username='$forgotusername' LIMIT 1" ;
if ($result -> num_rows > 0){
  header('Location: forgotpassword.php');
}
else{
  echo "Username does not exist";
}
}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/login-style.css">

</head>
<body>
    <img src="images/Maple_Leaf.svg" alt="Canada" id="mapleLeaf">
  <div class="container" id="sign-in">
    <div>
    <br>
    <h2 align="center" id="login-txt">Sign in</h2>
    <form name="login-form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
      <br>
      <h6 id="invalid-text"> Username and Password combination is invalid</h3>
      <div class="form-group">
        <input type="text" class="form-control" id="username" placeholder="username" name="login-username" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" placeholder="Password" name="login-password" required>
      </div>

      <button type="submit" class="submit" id="submit" name="submit-login">Submit</button>
      <br>

    </form>
  </div>


    <h6 onclick="enterpassword()" id="forgotten-password" class="click-here"> Forgot password? click here</h6>
    <form name="password-form" id="password-form" action="forgotpassword.php"method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="text" class="form-control" id="forgot-username" placeholder="Email" name="forgot-email" required>
      <button type="submit" class="submit-pass" id="submit-pass" name="submit-pass">Submit</button>
    </form>
  </div>
<script>

function enterpassword(){
  document.getElementById('forgotten-password').style.display="none";
  document.getElementById('password-form').style.display="block";
}

</script>

<?php


$sql = "SELECT COUNT(*)as count FROM ACCOUNTS " ;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$count = $row[count];


if($count>10){

echo "<div id='count' align='center' style='color:white' >";
echo "<h1> Join <br>";
echo  number_format($count);
echo "<br> Users </h1>";


$conn->close();

}
?>







</body>
</html>
