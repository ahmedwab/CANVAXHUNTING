<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Primary Meta Tags -->
    <title>canvaxsearch — Finding Vaccines for Canadians </title>
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

    <!-- Style -->
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
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JHJ9Q588ND"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JHJ9Q588ND');
</script>

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

    // Add all the field values here after post request
    document.addEventListener('DOMContentLoaded', (event) => {
      var p = "<?php echo $_POST['province'] ?>";
      if(p){
          document.getElementById("province-label").innerText =p;
        }
      var age = "<?php echo $_POST['age'] ?>";
      if(age){
          document.getElementById("age-label").innerText =age;
        }
  })

</script>
  <body>
    <section class="section-1">
      <div class="container">
        <a href="index.php">
        <img
          src="./images/maple.png"
          draggable="false"
          alt="maple leaf"
          id="logo"
        />
      </a>
        <h1>Canada Vaccine Search</h1>
        <form class="form-control form-control-row"  action="" method="post" name='search-form'>
          <div class="input-field-container">
            <h5 class="title">Province or territory *</h5>
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
            <input type="hidden" name="province" id="province" value="<?php echo $_POST['province'] ?>">
          </div>
          <div class="input-field-container input-field-container-small">
            <h5 class="title">Age(optional)</h5>
            <div class="dropdown input-container-input" onmouseover="handleOpenDropdown('dropdown-list-age')" onmouseout="handleCloseDropdown('dropdown-list-age')">
              <div class="dropdown-select">
                <span class="select" id="age-label" >Select Age Range</span>
                <i class="fa fa-caret-down icon"></i>
              </div>
              <div class="dropdown-list" id="dropdown-list-age">
                <div class="dropdown-list__item" onclick="handleAge(this)">Any</div>
                <div class="dropdown-list__item" onclick="handleAge(this)">18+</div>
                <div class="dropdown-list__item" onclick="handleAge(this)">30+</div>
                <div class="dropdown-list__item" onclick="handleAge(this)">40+</div>
                <div class="dropdown-list__item" onclick="handleAge(this)">50+</div>
              </div>
            </div>
            <input type="hidden" name="age" id="age" value="<?php echo $_POST['age'] ?>">
          </div>

          <div class="input-field-container">
            <h5 class="title">Public Health Unit(optional)</h5>
            <div class="input-container-input">
              <input type="text" id="city"  name="city" placeholder="Type your city" value="<?php echo $_POST['city'] ?>"/>
            </div>
          </div>

        
          <div class="input-field-container">
            <h5 class="title">Postal Code(optional)</h5>
            <div class="input-container-input">
              <input type="text" id="postalCode" maxlength="3" name="pcode" placeholder="Type your postal code area: M1W" value="<?php echo $_POST['pcode'] ?>"/>
            </div>
          </div>
          
          <div class="input-field-container">
            <div class="btn" onClick="document.forms['search-form'].submit();">
              <i class="fa fa-search"></i>
              <span class="btn-label">Search</span>
            </div>
          </div>
        </form>
        <br><br><h4 style="color:grey"> Note: Less input = More Results </h4>
      </div>
      
    </section>
    


    <?php
//get user inputs
$province = $_POST['province'];

$age = $_POST['age'];
if($age=='Any') $age=NULL;
$age = substr($age, 0, -1);
$city = $_POST['city'];
$city = strtolower($city);
$city = '\'' . $city . '\'';
$postalcode = $_POST['pcode'];
$postalcode = '\'' . $postalcode . '\'';
$postalcode = strtolower($postalcode);

//database information
$servername = "mysql.canvaxsearch.com";
$username = "canvaxadmin";
$password = "Cvs14072510";
$databaseName = "canvaxdb";

$conn = new mysqli($servername, $username, $password, $databaseName);

$sql = "SELECT * FROM tweet 
 WHERE province ='$province'
 ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

echo '
    <section class="section-2">
      <div class="container">';

     

$count = 0;
if ($result->num_rows > 0)
{
    // output data of each post
    echo '<h2>Search Results</h2>
        <div class="result-modules"> ';

    $hasResult = 0;

    while ($row = $result->fetch_assoc())
    {
        $id = $row["tweet_id"];
        $curltext = "https://publish.twitter.com/oembed?url=";
        $url = $curltext . "https://twitter.com/VaxHuntersCan/status/" . $id;
        $ch = curl_init();
        // Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);

      

        //table elements
        $age_groups = $row["age_groups"];
        $age_groups = substr($age_groups, 1, -1);

        //table elements
        $cities = $row["cities"];
        $cities = substr($cities, 1, -1);
        $cities = explode(',', $cities);

        $cities = array_map('strtolower', $cities);

        $inCity = 0;

        $city2 = ' ' . $city;
        if (in_array($city, $cities) || in_array($city2, $cities))
        {
            $inCity = 1;
        }
        $hasPostal=0;
        //table elements
        $FSAs = $row["FSAs"];
        if(strlen($FSAs)>=1){
          $hasPostal=1;
      }
        $FSAs = substr($FSAs, 1, -1);
        $FSAs = explode(',', $FSAs);

        $FSAs = array_map('strtolower', $FSAs);

        $inPostal = 0;

        $postalcode2 = ' ' . $postalcode;
        if (in_array($postalcode, $FSAs) || in_array($postalcode2, $FSAs))
        {
            $inPostal = 1;
        }

        $inArea = (($inCity&&$inPostal) || ($hasPostal==0 && $inCity));
        $isEmpty = $city == '\'\'' && $postalcode == '\'\'';

       
        if ($count < 20)
        {
            if (($age == NULL || $age == $age_groups) && ($inArea || $isEmpty))

            {
              $res = curl_exec($ch);

              $decoded_data = json_decode($res);
                $hasResult = 1;

                echo '<div class="result-module">' . "$decoded_data->html" .

                "</div>";
                $count += 1;

            }
        }

    }

    echo '</div>';

}
if ($count <= 0 && $province != NULL)
{
    echo '<h3> No results found </h3><br>';
}
else if (($hasResult == 0 || $result->num_rows <= 0) && $province != NULL)
{
    echo '<h3> No results found </h3><br>';
}
echo '   
    </div> 
    </section>';
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
                  id="subCity"
                  name='subCity'
                  placeholder="City: Toronto" maxlength="255"
                />
              </div>
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
if ($_SERVER["REQUEST_METHOD"] == "GET")
{

    $stmt = $conn->prepare("INSERT INTO EMAILS (EMAIL,CITY, POSTALCODE) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $scity, $pcode,);

    // set parameters and execute
    $email = $_GET['subEmail'];
    $scity = $_GET['subCity'];
    $pcode = $_GET['subPostalCode'];
    if ($stmt->execute())
    {
        echo "<h3> You are now subscribed to receive notifications</h3>";
    }

}

$stmt->close();
$conn->close();

?>
      <section class="footer-bottom">
        <div class="container">
          <section class="footer-bottom">
            <div class="container">
              <div>
                <p>No affiliation with any government or public health entity. ©2021 Canvaxsearch, All Rights Reserved.</p>
              </div>
              <div>
                <a href="/privacy.html">Privacy Policy</a>
                <a href="/terms.html">Terms of use</a>
              </div>
                <p>Developed by:
                <a href="https://github.com/oseisaac">Isaac Ose</a>
                &
                <a href="https://github.com/ahmedwab">Ahmed Abdelfattah</a></p>
                <p>Special Thanks to:
                <a href="http://vaccineupdates.ca">http://vaccineupdates.ca</a>, <a href="https://twitter.com/VaxHuntersCan">@VaxHuntersCan</a></p>
                <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>

            </section>
        </section>
    </div>
    </footer>
  </body>
</html>


