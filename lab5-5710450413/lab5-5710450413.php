<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lab5 ja</title>
<link rel="stylesheet" type="text/css" href="stylelab5.css">
<script>

function loadXMLDoc() {
	if(validate == true){
		alert("Hello,"+fname.value)
    	var e = document.getElementById("province");
    	var str = e.options[e.selectedIndex].text;
		var pprovince = "จังหวัด" +str;
		var mt = "lab4/motto/"+str+".txt"
		var ssign ="lab4/sign/"+str+".png";
		$('#detailpro').show();
  		var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
      		document.getElementById("motto").innerHTML = this.responseText ;	
			$("#sign").attr("src","lab4/sign/"+str+".png");

		
			
    		}
  		};
		var mt = "lab4/motto/"+str+".txt"
  		xhttp.open("GET",mt, true);
 		xhttp.send();
		}}
</script>
</head>


<body>

<?php
 
 $validate = true;
$fnameErr = $lnameErr = $genderErr = $bdayErr = $provErr = "";
$fname = $lname = $gender = $bday = $prov = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 	
	//check firstname
  if (empty($_POST["fname"])) {
	  $validate = false;
    $fnameErr = "*Firstname is required";
  } else {
    $fname = test_input($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
	//check lastname  
  if (empty($_POST["lname"])) {
	  $validate = false;

    $lnameErr = "*Lastname is required";
  } else {
    $lname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
    
	//check gender
  if (empty($_POST["gender"])) {
    $validate = false;
	$genderErr = "*Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

	//check bday
  if (empty($_POST["bday"])) {
    $validate = false;
	$bdayErr = "*Birthday is required";
  } else {
    $bday = test_input($_POST["bday"]);
  }
  
  	//check province
   if (empty($_POST["province"])) {
    $validate = false;
	$provErr = "*Province is required";
  } else {
    $prov = test_input($_POST["province"]);
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;



}
$getselect = $_POST['province'];
$mottoja = $getselect;
echo $mottoja;
$motto = "lab5/motto/"+$mottoja+".txt";

?>


<form class="formja" id="myform" method="post" action="">

<p>&nbsp;</p>
<table id="tbtb" width="474" border="0" class="my-border" >
  <tr>
    <td width="150"> <b> Firstname : </b	></td>
    <td width="289"><input type="text" name="fname" id="fname"value="<?php echo $fname;?>">
    <span class="error"> <?php echo $fnameErr;?></span>
    </td>
  </tr>
  <tr>
    <td><b> Lastname : </b></td>
    <td><input type="text" name="lname" id="lname" value="<?php echo $lname;?>">
    <span class="error"> <?php echo $lnameErr;?></span>
    </td>
  </tr>
  <tr>
    <td><b> Birthday : </b></td>
    <td><input type="date" name="bday" id="bday" value="<?php echo $bday;?>" ></br>
    <span class="error"> <?php echo $bdayErr;?></span>
    </td>
  </tr>
  <tr>
    <td><b> Gender : </b></td>
    <td>
    <section id="first" class="section">
     <div class="container">
      <input type="radio" name="gender" id="radio-1" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
      <label for="radio-1"><span class="radio">Male</span></label>
    </div>
    <div class="container">
      <input type="radio" name="gender" id="radio-2" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
      <label for="radio-2"><span class="radio"> Female</span></label></br>
    </div>
	</section>
    <span class="error"> <?php echo $genderErr;?></span>
    </td>
  </tr>
  <tr>
    <td><b> Province : </b></td>
    
    <td>

 	<select name="province" value="<?php echo $prov;?>">
	<option value=""></option>
	<?php
	$file ="lab5/allProvince.txt";
	$document = file_get_contents($file);

	$provnotsplit = $document;
	$provsplit =(explode(".txt",$provnotsplit));
	for($i=0; $i<count($provsplit); $i++){?>
    <option value="<?php echo $provsplit[$i]; ?>"><?php echo $provsplit[$i]; ?>
    </option>
	<?php
	}
	?>
	</select>
	<span class="error"> <?php echo $provErr;?></span>
 
    </td>
  </tr>
  <tr >
    <td colspan="2" align="center">
    	<input type="submit" name="submit" value="Submit" onClick="loadXMLDoc()" >
    	<input type="button" name="cancel" value="Cancel">

  </tr>
</table>
</form>

<p>
  <?php 
$displayform = False;
if(isset($_POST['submit'])){
	$displayform = True;
	
	}
if($displayform && $validate == true){
	?>
</p>
<p>&nbsp; </p> 
<form class="formjaja" method = "post">
  
  <table id="detailpro" width="700" border="0" class="my-border"  " >
  <tr >
    <td colspan="2" >จังหวัด<?php echo $getselect;?></p></td>
  </tr>
  <tr>
    <td i><img id="sign" width="200" height="200" ></img></td>
  	<td id="motto"><p width=10% > </p></td>
  </tr>
  

</table>


</form>	
<?php
	}

?>
 


</body>
</html>