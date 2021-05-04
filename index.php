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
    <link rel="stylesheet" href="./stylesheets/global-style.css" />
    <link rel="stylesheet" href="./stylesheets/main-styles.css" />
  </head>
  <script>
    const getProvinces = (e) =>{
      document.getElementById("province-label").innerText = e.innerText;
      document.getElementById("province").value = e.innerText;
      handleCloseDropdown("dropdown-list-province");
    }
    const handleAge = (e) =>{
      document.getElementById("age-label").innerText = e.innerText;
      document.getElementById("age").value = e.innerText;
      handleCloseDropdown("dropdown-list-age");
    }
    const handleOpenDropdown=(id)=>{
      const ele = document.getElementById(id);
      ele.classList.add("dropdown-open");
    }
    const handleCloseDropdown=(id)=>{
      const ele = document.getElementById(id);
      ele.classList.remove("dropdown-open");
    }
</script>
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
            <div class="dropdown input-container-input" onmouseover="handleOpenDropdown('dropdown-list-province')" onmouseout="handleCloseDropdown('dropdown-list-province')">
              <div class="dropdown-select">
                <span class="select" id="province-label" >Select Provice or Territory</span>
                <i class="fa fa-caret-down icon"></i>
              </div>
              <div class="dropdown-list" id="dropdown-list-province">
                <div class="dropdown-list__item" onclick="getProvinces(this)">AB</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">BC</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">MB</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">NB</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">NU</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">NT</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">NL</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">NS</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">ON</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">PE</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">QC</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">SK</div>
                <div class="dropdown-list__item" onclick="getProvinces(this)">YT</div>
              </div>
            </div>
            <input type="hidden" name="province" id="province">
          </div>
          <div class="input-field-container input-field-container-small">
            <h5 class="title">Age(optional)</h5>
            <div class="dropdown input-container-input" onmouseover="handleOpenDropdown('dropdown-list-age')" onmouseout="handleCloseDropdown('dropdown-list-age')">
              <div class="dropdown-select">
                <span class="select" id="age-label" >Select Age Range</span>
                <i class="fa fa-caret-down icon"></i>
              </div>
              <div class="dropdown-list" id="dropdown-list-age">
                <div class="dropdown-list__item" onclick="handleAge(this)">18+</div>
                <div class="dropdown-list__item" onclick="handleAge(this)">30+</div>
                <div class="dropdown-list__item" onclick="handleAge(this)">40+</div>
                <div class="dropdown-list__item" onclick="handleAge(this)">50+</div>
              </div>
            </div>
            <input type="hidden" name="age" id="age">
          </div>
        
          <div class="input-field-container">
            <h5 class="title">Postal Code(optional)</h5>
            <div class="input-container-input">
              <input type="text" id="postalCode" maxlength="3" name="pcode" placeholder="Type your postal code area: M1W"/>
            </div>
          </div>
          <div class="input-field-container">
            <h5 class="title">City(optional)</h5>
            <div class="input-container-input">
              <input type="text" id="city"  name="city" placeholder="Type your city"/>
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
$servername = "mysql.canvaxsearch.com";
$username = "canvaxadmin";
$password = "Cvs14072510";
$databaseName = "canvaxdb";

 $conn = new mysqli($servername,$username,$password,$databaseName);


 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  


    // collect value of input fields
    $province = $_POST['province'];
    $postalCode = $_POST['pcode'];
    $city =$_POST['city'];
    $agegroup =$_POST['age'];
    // Find posts with the same province and postal code information

    $agestmt="";
    $postalstmt="";
    $citystmt="";
    
    if ($agegroup!=NULL){
      $agegroup=substr($agegroup, 0, -1);
      $agestmt="AND I.AGE = '$agegroup '";
    }
    if ($postalCode!=NULL){
      $postalstmt="AND I.POSTALCODE = '$postalCode '";
    }
    if ($city!=NULL){
      $citystmt="AND I.CITY = '$city '";
    }

    $sql = "SELECT * FROM POSTS P, POSTINFO I
    WHERE P.POST_ID = I.ID
    AND
    I.PROVINCE = '$province'"
    .$agestmt.$postalstmt.$citystmt.
    "
    GROUP BY P.POST_ID
    ORDER BY DATE DESC";

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
        $link=$row["EMBEDDED_LINK"];

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
            <h3>Want to get notified when a vaccine is available?</h3>
          </div>
          <form class="form-control form-control-row"  action="" method="get" name='subscribe-form'>
            <div class="input-field-container">
              <div class="input-container-input">
                <input
                  type="text"
                  id="subEmail"
                  name="subEmail"
                  placeholder="someone@example.com"
                />              </div>
            </div>
            <div class="input-field-container">
              <div class="input-container-input">
                <input
                  type="text"
                  id="subPostalCode"
                  name='subPostalCode'
                  placeholder="Postal Code: M1W" maxlength="3"
                />
              </div>
            </div>
            <div class="input-field-container" >
              <div class="btn btn-outline" onclick="document.forms['subscribe-form'].submit();">
                <span class="btn-label">Subscribe</span>
              </div>
            </div>
          </form>
        </div>
      </section>

  <?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {


 

$stmt = $conn->prepare("INSERT INTO EMAILS (EMAIL, POSTALCODE) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $pcode,);

// set parameters and execute
$email = $_GET['subEmail'];
$pcode = $_GET['subPostalCode'];
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
            <a href="mailto:contact@canvaxsearch.com">Contact Us</a>.<br> 
            <a href="/privacy.html">Privacy Policy</a>
            <a href="/terms.html">Terms of use</a>
            <p>Developed by:</p>
            <a href="https://github.com/oseisaac">Isaac Ose  </a>&
            <a href="https://github.com/ahmedwab">Ahmed Abdelfattah</a>
        </section>
    </div>
    </footer>
  </body>
</html>

<script>
    const getProvinces = (e) =>{
      document.getElementById("province-label").innerText = e.innerText;
      document.getElementById("province").value = e.innerText;
      handleCloseDropdown("dropdown-list-province");
    }
    const handleAge = (e) =>{
      document.getElementById("age-label").innerText = e.innerText;
      document.getElementById("age").value = e.innerText;
      handleCloseDropdown("dropdown-list-age");
    }
    const handleOpenDropdown=(id)=>{
      const ele = document.getElementById(id);
      ele.classList.add("dropdown-open");
    }
    const handleCloseDropdown=(id)=>{
      const ele = document.getElementById(id);
      ele.classList.remove("dropdown-open");
    }
</script>

