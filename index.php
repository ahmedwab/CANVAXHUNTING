<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Canada Vaccine Search</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="./stylesheets/reset.css" />
    <link rel="stylesheet" href="./stylesheets/global.css" />
    <link rel="stylesheet" href="./stylesheets/main-style.css" />
  </head>
  <body>
    <section class="section-1">
      <div class="container">
        <img
          src="./images/maple.png"
          draggable="false"
          alt="maple leaf"
          id="logo"
        />
        <h1>Canada Vaccine Search</h1>
        <form class="form-control form-control-row"  action="" method="post" name='search-form'>
          <div class="input-field-container">
            <h5 class="title">Province or territory</h5>
            <div class="dropdown input-container-input">
              <div class="dropdown-select">
                <span class="select" id="province-label" >Select Provice or Territory</span>
                <i class="fa fa-caret-down icon"></i>
              </div>
              <div class="dropdown-list">
                <div class="dropdown-list__item">Alberta</div>
                <div class="dropdown-list__item">British Columbia</div>
                <div class="dropdown-list__item">New Brunswick</div>
                <div class="dropdown-list__item">Newfoundland and Labrador</div>
                <div class="dropdown-list__item">Nova Scotia</div>
                <div class="dropdown-list__item">Ontario</div>
                <div class="dropdown-list__item">Prince Edward Island</div>
                <div class="dropdown-list__item">Quebec</div>
                <div class="dropdown-list__item">Saskatchewan</div>
                <div class="dropdown-list__item">Northwest Territories</div>
                <div class="dropdown-list__item">Nunavut</div>
                <div class="dropdown-list__item">Yukon</div>
              </div>
            </div>
            <input type="hidden" name="province" id="province">
          </div>
          <div class="input-field-container">
            <h5 class="title">Postal Code</h5>
            <div class="input-container-input">
              <input type="text" id="postalCode" maxlength="3" name="pcode" placeholder="Type your postal code"/>
            </div>
          </div>
          <div class="input-field-container">
            <div class="btn" onClick="document.forms['search-form'].submit();">
              <i class="fa fa-search"></i>
              <span class="btn-label">Search</span>
            </div>
          </div>
        </form>
      </div>
    </section>
    


<?php

//database information
$servername = "mysql.canvaxsearch.dreamhosters.com";
$username = "ahmedwal";
$password = "discussion1407";
$databaseName = "canvaxsearch";

 $conn = new mysqli($servername,$username,$password,$databaseName);


 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  


    // collect value of input fields
    $province = $_POST['province'];
    $postalCode = $_POST['pcode'];
    // Find posts with the same province and postal code information



    $sql = "SELECT * FROM POSTS WHERE PROVINCE='$province' AND POSTALCODE='$postalCode' ORDER BY DATE DESC";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    
    echo'
    <section class="section-2">
      <div class="container">
        <h2>Search Results</h2>
        <div class="result-modules">';
          
       

    if ($result->num_rows > 0) {
      // output data of each post

      while($row = $result->fetch_assoc()) {
        $link=$row["LINK"];

        echo'<div class="result-module">'
        .$link.
        
        "</div>";
        

      }
    }
    else{
      echo'<h3> No Results Found </h3>';
    }
    echo'
    </div>
    </div>
  </section>';
  
}
?>




<footer>
      <section class="footer-top">
        <div class="container">
          <div class="label">
            <h3>Notify me when a vaccine is available</h3>
          </div>

          <form action="" method="get">
            <input type="text" id="email" name="email" placeholder="someone@example.com">
            <input type="text" id="postalcode" name="pcode" placeholder="Postal Code: M1W" maxlength="3">
            <input type="submit" value="Subscribe">
          </form>
        </div>
      </section>

  <?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {


 

$stmt = $conn->prepare("INSERT INTO EMAILS (EMAIL, POSTALCODE) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $pcode,);

// set parameters and execute
$email = $_GET['email'];
$pcode = $_GET['pcode'];
if ($stmt->execute()) { 
  echo"<h3> You are now subscribed to receive notifications</h3>";
} 

}

  
$stmt->close();
$conn->close();





?>
      <section class="footer-bottom">
        <div class="container">
            <p>No affiliation with any government or public health entity.<br>
            <p>©2021 Canvaxsearch, All Rights Reserved.</p>
            <a href="/privacy.html">Privacy Policy</a>
            <a href="/terms.html">Terms of use</a>
            <a href="/login.php">Login</a>
            <p>Developed by:</p>
            <a href="https://github.com/oseisaac">Isaac Ose</a>
            <p>&</p>
            <a href="https://github.com/ahmedwab">Ahmed Abdelfattah</a>
        </section>
    </div>
    </footer>
  </body>
</html>

<script>

  const provinces = document.getElementsByClassName("dropdown-list__item");

  const getProvinces = (e) =>{
    document.getElementById("province-label").innerText = e.target.innerText;
    document.getElementById("province").value = e.target.innerText;
  }

  for(const ele of provinces){
    ele.addEventListener("click",getProvinces);
  }



</script>

