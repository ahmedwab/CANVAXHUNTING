
<?php 
    //database information
    $servername = "mysql.canvaxsearch.com";
    $username = "canvaxadmin";
    $password = "Cvs14072510";
    $databaseName = "canvaxdb";  
    
    $conn = new mysqli($servername,$username,$password,$databaseName);    
    
    $email =$_GET['email'];
    $sql = "DELETE FROM EMAILS WHERE EMAIL='$email'"; 
    $result = $conn->prepare($sql);
    if ($result->execute() === TRUE) {  
      echo "Email has been unsubscribed";
      } 
    else {  
        echo "There was a problem unsubscribing the email.
        <br> 
        Please contact contact@canvaxsearch.com" ;
    }  
  $stmt->close();
  $conn->close();
        
?>  