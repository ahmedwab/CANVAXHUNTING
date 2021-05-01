<html>
   <body>
   <img src="images/Maple_Leaf.svg" alt="Canada" id="mapleLeaf">
         <head>
            <title> Canada Vaccine Search</title>
            <link rel="stylesheet" href="stylesheets/login-style.css">
          </head>
      
      <div class="container" id="sign-in">
      <div>
         <br>
         <h2 align="center" id="login-txt">Add Post</h2>
         <form name="login-form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <div >
                Embedded Twitter Link: <input type="text" class="form-control" name="tname" placeholder='<blockquote class="twitter-tweet"><p lang="und" dir="ltr">[BC] <a href="https://t.co/jmFa5BMWkC">https://t.co/jmFa5BMWkC</a> <a href="https://twitter.com/hashtag/COVID19?src=hash&amp;ref_src=twsrc%5Etfw">#COVID19</a> <a href="https://twitter.com/hashtag/COVID19Vaccine?src=hash&amp;ref_src=twsrc%5Etfw">#COVID19Vaccine</a> <a href="https://twitter.com/hashtag/COVID19BC?src=hash&amp;ref_src=twsrc%5Etfw">#COVID19BC</a> <a href="https://twitter.com/hashtag/vhcBC?src=hash&amp;ref_src=twsrc%5Etfw">#vhcBC</a></p>&mdash; Vaccine Hunters Canada (@VaxHuntersCan) <a href="https://twitter.com/VaxHuntersCan/status/1387934255041372160?ref_src=twsrc%5Etfw">April 30, 2021</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>"'><br>            </div>
            <div class="form-group">
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
            </div>
            Postal Code: <input type="text" class="form-control" name="pcode"  placeholder="Ex: M3J M3K M3M M3N M6M M9L M9M M9N" required><br>
            <button type="submit" class="submit" id="submit" name="submit-login">Submit</button>
            <br>
         </form>
      </div>
      <?php
         //database information
         $servername = "mysql.canvaxsearch.dreamhosters.com";
         $username = "ahmedwal";
         $password = "discussion1407";
         $databaseName = "canvaxsearch";
         
          $conn = new mysqli($servername,$username,$password,$databaseName);
         
          session_start();
          error_reporting(0);
          if ($_SESSION["user"] == NULL)
          {
             header('Location: index.php');
          }
         
          
         
          //if a post request is submitted
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
           // collect value of input fields
           $pname = $_POST['tname'];
           $postalCode = $_POST['pcode'];
           $postalcodes = explode (" ", $postalCode); 
           $province = $_POST['province'];
         
           //check if fields are properly inputted.
           if (empty($pname)||strlen($postalCode)<3) {
             echo "Name is empty";
           } else {
            for($i = 0; $i < count($postalcodes); $i++) {
              $postalCode = $postalcodes[$i];
             //inserts post information to the posts table
             $sql = "INSERT INTO POSTS (LINK, PROVINCE,POSTALCODE)
             VALUES ('$pname' ,'$province','$postalCode')";
         
             if (mysqli_query($conn, $sql)) {
               echo "New record created successfully<br>";
             } else {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
             }
         
         
         
             //sending email notifications to everyone with inputted postal code.
             $sql = "SELECT EMAIL FROM EMAILS WHERE POSTALCODE = '$postalCode'";
             $result = $conn->query($sql);
         
             if ($result->num_rows > 0) {
               // output data of each row
               while($row = $result->fetch_assoc()) {
                 $email=$row["EMAIL"];
         
                 $to = "".$email."";
                 $subject = "We found Vaccines for you";
             
                 $message = '
                 <html>
                 <head>
                 <title>HTML email</title>
                 </head>
                 <body>'
                 .$pname.
                 //href should be replaced with a link to the unsubscribe page
                 '</body>
                 </html>
                 ';
         
               }
             }
             
             
             // Content type
             $headers = "MIME-Version: 1.0" . "\r\n";
             $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
             
             // More headers
             // Sender should probably be a no-reply@something.com
             $headers .= 'From: <no-reply@canvaxsearch.com>' . "\r\n";
             
             $wasMailed=mail($to,$subject,$message,$headers);
             if( $wasMailed == true ) {
                 echo "Message sent successfully...";
              }else {
                 echo "No messages sent...";
              }
             
           }
          }
         }
         ?>
   </body>
</html>