<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webtech";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cusId = $citiid = $fname = $lname = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $cusId = $_POST["cusid"];
	  $citiid = $_POST["citiid"];
	  $fname = $_POST["fname"]; 
	  $lname = $_POST["lname"];

}
	$sql = "INSERT INTO Customers (CustomerID, CitizanID,Firstname,Lastname)
    VALUES ('$cusId', '$citiid', '$fname','$lname')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
<?php
// define variables and set to empty values


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
echo $fname;

?>
<body>
<p>&nbsp;</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table width="538" border="0">
  <tr>
    <td>CustomerID : </td>
    <td><input type="text" name="cusid" ></td>
    <td>CitizenID :</td>
    <td><input type="text" name="citiid" ></td>
  </tr>
  <tr>
    <td>Firstname :</td>
    <td><input type="text" name="fname" ></td>
    <td>Lastname :</td>
    <td><input type="text" name="lname" ></td>
  </tr>
   <tr>
    <td colspan="4" align="center"><input type="submit" Value="Submit"></td>
  </tr>
</table>
<form>
<?php

?>

</body>
</html>