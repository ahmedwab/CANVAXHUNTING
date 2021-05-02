<?php
session_start();
error_reporting(0);


//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";


$conn = new mysqli($servername,$username,$password,$databaseName);

 $token= $_GET['token'];

 $accountusername = NULL;

 $sql="SELECT * FROM PASSWORD WHERE TOKEN='$token' ";
 
 $stmt = $conn->prepare($sql); 
 $stmt->bind_param("i", $id);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result-> num_rows>0){
    while($row = $result->fetch_assoc()){
        $accountusername = $row['EMAIL'];
         
    }
 }
 else{
     echo "something went wrong";
 }




 $stmt->close();
 $conn->close();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Recover Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/login-style.css">
<script src="script.js"></script>

</head>
<body>
<img src="images/Maple_Leaf.svg" alt="Canada" id="mapleLeaf">
<div class="container" id="sign-in">
      <div>
      <br>
      <h2 align="center" id="login-txt"><?php echo $accountusername;?></h2><br>
    <form name="login-form" action="updatepassword.php" method="post">  
            <div class="form-group">
            <input type="hidden" name="update-email" value="<?php echo $accountusername;?>">
            <input type="password" class="form-control" id="password" placeholder="New Password" name="update-password" required>
        </div>
       

        <button type="submit" class="submit" id="update-submit" name="submit-password">Submit</button>
    </form>
        <a align="center" href="login.php"><h3> Go back</h3></a><br>
      
    </div>









</body>
</html>
