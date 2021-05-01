<?php
session_start();
error_reporting(0);

//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";

 $conn = new mysqli($servername,$username,$password,$databaseName);


 $accountusername= $_POST['forgot-email'];

 $emailtext=md5($accountusername). md5(date_default_timezone_get());
 

 $sql="SELECT EMAIL FROM ACCOUNTS WHERE EMAIL='$accountusername' ";
 $result = $conn->query($sql);




 if ($result -> num_rows > 0){
    
 
  



  $query = "INSERT INTO PASSWORD (TOKEN, EMAIL)
  VALUES ( '$emailtext', '$accountusername')";



   $to = $accountusername;
         $subject = "Password recovery";
         
         $message = "<b>Click the link to recover password.</b>";
         $message .= "http://canvaxsearch.dreamhosters.com/recoverpassword.php?token=" . $emailtext;
         
         $header = "From:no-reply@canvaxsearch.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);


 }
 else {
     echo "something went wrong";
 }
 echo '
 <div class="container" id="sign-in">
   <div>
   <br>
   <h2 align="center" id="login-txt">An Email will be sent to you if valid</h2><br>
   <a align="center" href="login.php"><h3> Go back</h3></a><br>
   
 </div>';





 $conn->close();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgot Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/login-style.css">
<script src="script.js"></script>

</head>
<body>









</body>
</html>
