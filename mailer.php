<?php

// mailing system


//database information
$servername = "mysql.canvaxsearch.com";
$username = "canvaxadmin";
$password = "Cvs14072510";
$databaseName = "canvaxdb";

 $conn = new mysqli($servername,$username,$password,$databaseName);
 

 $sql = "SELECT * FROM MAILER 
 ORDER BY DATE DESC
 LIMIT 1
 " ;
 
    $lastmail=NULL;

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result(); 

    while($row = $result->fetch_assoc()) {

        $lastmail = $row["DATE"];

    }

    $sql = "SELECT * FROM tweet 
    WHERE created_at>'$lastmail'
    ORDER BY created_at DESC ";
 

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result(); 

    while($row = $result->fetch_assoc()) {

        $id=$row["tweet_id"];
        $tweetid= $row["id"];
       




        //table elements
        $cities=$row["cities"];
        $cities = substr($cities, 1, -1);
       $cities = explode(',', $cities);

       $cities = array_map('strtolower', $cities);


           

       //table elements
       $FSAs=$row["FSAs"];
       $FSAs = substr($FSAs, 1, -1);
      $FSAs = explode(',', $FSAs);

      $FSAs = array_map('strtolower', $FSAs);


      $curltext="https://publish.twitter.com/oembed?url=";
      $url = $curltext."https://twitter.com/VaxHuntersCan/status/".$id;
      $ch = curl_init(); 
      // Return Page contents.
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

     //grab URL and pass it to the variable.
         curl_setopt($ch, CURLOPT_URL, $url);

         $res = curl_exec($ch);

         $decoded_data = json_decode($res);
         $emailtext="$decoded_data->html";

      

          


      $sql2 = "SELECT * FROM EMAILS";
      $st = $conn->prepare($sql2); 
      $st->bind_param("i", $id);
      $st->execute();
      $re = $st->get_result();
      while ($row2 = $re->fetch_assoc()) {

        $email = $row2['EMAIL'];
        $city = $row2['CITY'];
        $city = strtolower($city);
        $city = '\'' .$city .'\'';
        $postalcode = $row2['POSTALCODE'];
        $postalcode = '\'' .$postalcode .'\'';
        $postalcode = strtolower($postalcode);


        $inPostal = 0;

        $postalcode2 = ' '.$postalcode;
        if(in_array($postalcode,$FSAs)||in_array($postalcode2,$FSAs)){
            $inPostal = 1;
        }

        $inCity = 0;

        $city2 = ' '.$city;
        if(in_array($city,$cities)||in_array($city2,$cities)){
             $inCity = 1;
        }



            if($inCity||$inPostal){
               
        
            $subject = "We found Vaccines for you";
            $to = $email;
            $message = '
            <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>'
            .$emailtext.
            //href should be replaced with a link to the unsubscribe page
            '<p>Want to Unsubscribe? Click the following</p> <br>
            https://canvaxsearch.com/unsubscribe.php?email='.$email.'
            </body>
            </html>
            ';


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

            $stmt2 = $conn->prepare("INSERT INTO MAILER (ID) VALUES (?)");
            $stmt2->bind_param("i", $mailid);
    
            // set parameters and execute
            $mailid = $tweetid;
            if ($stmt2->execute()) { 
                echo"<h3> New Mailer has been added</h3>";
            }     


      }

    
      


        

           
            

    }










?>