<!DOCTYPE html>
<html>

<head>
<title> Canada Vaccine Search</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<img src="images/Maple_Leaf.svg" alt="Canada" id="mapleLeaf">
<h1 id="title"> Canada Vaccine Search</h1>
    <form action="" method="post">    



     <label for="province">Please choose a province or territory:</label>
    
        <select id="province" name="province">
            <option value="Alberta">Alberta</option>
            <option value="British Columbia">British Columbia</option>
            <option value="Manitoba">Manitoba</option>
            <option value="New Brunswick">New Brunswick</option>
            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
            <option value="Nova Scotia">Nova Scotia</option>
            <option value="Ontario">Ontario</option>
            <option value="Prince Edward Island">Prince Edward Island</option>
            <option value="Quebec">Quebec</option>
            <option value="Saskatchewan">Saskatchewan</option>
            <option value="Northwest Territories">Northwest Territories</option>
            <option value="Nunavut">Nunavut</option>
            <option value="Yukon">Yukon</option>
    
    
    
        </select>
        <br>
        Postal Code: <input type="text" name="pcode" maxlength="3" placeholder="Ex: M1W">
        <br>
      <input type="submit" name="submitpost" id='submit'>
    </form>

    <h3 align='center'> Want to receive notifications? </h3>
    <form action="" method="post"> 
        Email: <input type="text" name="email" placeholder='someone@example.com'>
        Postal Code: <input type="text" name="pcode" maxlength="3" placeholder= 'M1W'>
     <input type="submit" name='submitemail' id='submit'>
</form>


    
</body>
</html>




<?php

//database information
$servername = "";
$username = "";
$password = "";
$databaseName = "";

 $conn = new mysqli($servername,$username,$password,$databaseName);



 

 
if (isset($_POST['submitpost'])) {


    // collect value of input fields
    $province = $_POST['province'];
    $postalCode = $_POST['pcode'];


    // Find posts with the same province and postal code information

    $sql = "SELECT * FROM POSTS WHERE PROVINCE='$province' AND POSTALCODE='$postalCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each post

      echo '<div id="twitter-posts"> ';
      while($row = $result->fetch_assoc()) {
        $link=$row["LINK"];
        echo ' <div class="tweet">'.$link.'</div>';
        

      }
      echo '</div>';
    }
  
}


  //if an email post request is submitted

  else if (isset($_POST['submitemail'])) {
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
    echo "You will be notified through email when a vaccine is available for your postal code.<br>";
  } else {
    echo "Uh oh! Something went wrong<br>";
  }
    }


?>

</body>
</html>

