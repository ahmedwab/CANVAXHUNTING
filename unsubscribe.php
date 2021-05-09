<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Subscription</title>
    <!-- Primary Meta Tags -->
    <meta name="title" content="canvaxsearch — Finding Vaccines for Canadians "></meta/>
    <meta name="description" content="Canvax Search is an web-application that helps people get the </meta/>latest information on COVID-19 vaccine availability reported by vaccine  providers and </meta/>pharmacies in Canada based on the Vaccine Hunters twitter feed."></meta/>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website"></meta/>
    <meta property="og:url" content="https://canvaxsearch.com/"></meta/>
    <meta property="og:title" content="canvaxsearch — Finding Vaccines for Canadians "></meta/>
    <meta property="og:description" content="Canvax Search is an web-application that helps people </meta/>get the latest information on COVID-19 vaccine availability reported by vaccine  providers and </meta/>pharmacies in Canada based on the Vaccine Hunters twitter feed."></meta/>
    <meta property="og:image" content="./images/Cv.jpg"></meta/>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image"></meta/>
    <meta property="twitter:url" content="https://canvaxsearch.com/"></meta/>
    <meta property="twitter:title" content="canvaxsearch — Finding Vaccines for Canadians "></meta/>
    <meta property="twitter:description" content="Canvax Search is an web-application that helps </meta/>people get the latest information on COVID-19 vaccine availability reported by vaccine  </meta/>providers and pharmacies in Canada based on the Vaccine Hunters twitter feed."></meta/>
    <meta property="twitter:image" content="./images/Cv.jpg">
    <link
      async
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <link
      async
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="./stylesheets/global-style.css" />
    <link rel="stylesheet" href="./stylesheets/thankyou-style.css" />
  </head>
  <body>
    <section class="container">
        <div class="inner">
        <a href="index.php"><img src="./images/maple.png" draggable="false" alt="maple leaf" id="logo"/></a>
        <h5>Thank You!</h5>
            
    <?php
//database information
$servername = "mysql.canvaxsearch.com";
$username = "canvaxadmin";
$password = "Cvs14072510";
$databaseName = "canvaxdb";

$conn = new mysqli($servername, $username, $password, $databaseName);

$email = $_GET['email'];
$sql = "DELETE FROM EMAILS WHERE EMAIL='$email'";
$result = $conn->prepare($sql);
if ($result->execute() === true)
{
    echo "<p>
      You have been successfully removed from the subsriber list and won't recieve any future notifications from us.
      </p>";
}
else
{
    echo " <p>There was a problem unsubscribing the email.
        <br> 
        Please contact contact@canvaxsearch.com</p>";
}
$stmt->close();
$conn->close();

?>  
            
    </section>
  </body>
</html>
