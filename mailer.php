
<?php
// mailing system


//database information
$servername = "mysql.canvaxsearch.com";
$username = "canvaxadmin";
$password = "Cvs14072510";
$databaseName = "canvaxdb";

$conn = new mysqli($servername, $username, $password, $databaseName);

$emailArray=array();

$sql = "SELECT * FROM MAILER 
 ORDER BY DATE DESC
 LIMIT 1
 ";

$lastmail = NULL;

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{

    $lastmail = $row["DATE"];

}

echo $lastmail;
$sql = "SELECT * FROM tweet 
    WHERE ingested_at > '$lastmail'
    ORDER BY ingested_at DESC ";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{

    $id = $row["tweet_id"];
    $tweetid = $row["id"];

    //table elements
    $cities = $row["cities"];
    $cities = substr($cities, 1, -1);
    $cities = explode(',', $cities);

    $cities = array_map('strtolower', $cities);

    $hasPostal=0;
    //table elements
    $FSAs = $row["FSAs"];
    if(strlen($FSAs)>=1){
        $hasPostal=1;
    }
    $FSAs = substr($FSAs, 1, -1);
    $FSAs = explode(',', $FSAs);

    $FSAs = array_map('strtolower', $FSAs);

    $curltext = "https://publish.twitter.com/oembed?url=";
    $url = $curltext . "https://twitter.com/VaxHuntersCan/status/" . $id;
    $ch = curl_init();
    // Return Page contents.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //grab URL and pass it to the variable.
    curl_setopt($ch, CURLOPT_URL, $url);

    $res = curl_exec($ch);

    $decoded_data = json_decode($res);
    $emailtext = "$decoded_data->html";

    $sql2 = "SELECT * FROM EMAILS";
    $st = $conn->prepare($sql2);
    $st->execute();
    $re = $st->get_result();
    while ($row2 = $re->fetch_assoc())
    {

        $email = $row2['EMAIL'];
        $city = $row2['CITY'];
        $city = strtolower($city);
        $city = '\'' . $city . '\'';
        $postalcode = $row2['POSTALCODE'];
        $postalcode = '\'' . $postalcode . '\'';
        $postalcode = strtolower($postalcode);

        $count = $row2['COUNT'];
        
        $inPostal = 0;

        $postalcode2 = ' ' . $postalcode;
        if (in_array($postalcode, $FSAs) || in_array($postalcode2, $FSAs))
        {
            $inPostal = 1;
        }

        $inCity = 0;

        $city2 = ' ' . $city;
        if (in_array($city, $cities) || in_array($city2, $cities))
        {
            $inCity = 1;
        }

        
        if ((($inCity&&$inPostal) || ($hasPostal==0 && $inCity)) && $count < 2)
        {
           

            $subject = "We found Vaccines for you";
            $to = $email;
            $message = '
            <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>' . $emailtext .
            //href should be replaced with a link to the unsubscribe page
            '<p>Want to Unsubscribe? Click the following</p> <br>
            https://canvaxsearch.com/unsubscribe.php?email=' . $email . '
            </body>
            </html>
            ';

            // Content type
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            // Sender should probably be a no-reply@something.com
            $headers .= 'From: no-reply@canvaxsearch.com' . "\r\n";

            if (strlen($emailtext) > 10)
            {
                $wasMailed = mail($to, $subject, $message, $headers);
                if ($wasMailed == true)
                {
                    array_push($emailArray,$to);
                    $mailcount=$count+1;
                    $stmt3 = $conn->prepare("UPDATE EMAILS SET count ='$mailcount' WHERE EMAIL='$to'");
                    

                    $stmt3->execute();
                }
                else
                {
                   // echo "No messages sent...";
                }
            }
           

        }

        $stmt2 = $conn->prepare("INSERT INTO MAILER (ID) VALUES (?)");
        $stmt2->bind_param("i", $mailid);

        // set parameters and execute
        $mailid = $tweetid;
        if ($stmt2->execute())
        {
            echo "<h3> New Mailer has been added</h3>";
        }
       

        

    }

}
        $stmt3 = $conn->prepare("UPDATE EMAILS SET count =0");
                    

        $stmt3->execute();

//DELETE FROM `MAILER` WHERE ID>119
?>

