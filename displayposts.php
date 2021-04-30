
<html>
<body>

<h1> User Side </h1>
<h2> Get Posts</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">


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
Postal Code: <input type="text" name="pcode" maxlength="3">
  <input type="submit">
</form>

<?php

//database information
$servername = "";
$username = "";
$password = "";
$databaseName = "";

 $conn = new mysqli($servername,$username,$password,$databaseName);



 

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // collect value of input fields
    $province = $_POST['province'];
    $postalCode = $_POST['pcode'];
    echo $province. ' '.$postalCode;


    // Find posts with the same province and postal code information

    $sql = "SELECT * FROM POSTS WHERE PROVINCE='$province' AND POSTALCODE='$postalCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each post
      while($row = $result->fetch_assoc()) {
        $link=$row["LINK"];
        echo $link;
        

      }
    }
  
}


?>

</body>
</html>

