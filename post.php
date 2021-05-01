
<html>
<body>

<h2> Add post and send email</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Embedded Twitter Link: <input type="text" name="tname">
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
  Postal Code: <input type="text" name="pcode" >
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
  // collect value of input field
  $pname = $_POST['pcode'];
$postalcodes = explode (",", $pname); 

for($i = 0; $i < count($postalcodes); $i++) {
  echo $postalcodes[$i] ;
}

}

?>

</body>
</html>



