<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: doctors_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `doctors` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$doctor_password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'You have no Information yet in the Database</p>";
}


// check the url is set and exit in the database
$dynamic_lists = "";
if (isset($_GET['patient_id'])){
	$patient_id = $_GET['patient_id'];
	// use this var to check if the ID exist in the database, if yes, show the product details, if no
	// give message
	$sql6 = "SELECT * FROM `patient_rec` WHERE `hosp_no`='$patient_id' LIMIT 1";
	$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
	$resultCount6 = mysqli_num_rows($check6);
	if ($resultCount6>0){
		while($row=mysqli_fetch_array($check6)){
		$patient_surname=$row["sur_name"];
		$patient_firstname=$row["first_name"];
		$patient_lastname=$row["other_names"];
		$patient_hos_no=$row["hosp_no"];
		$date_of_birth=$row["date_of_birth"];
		$date_of_reg=$row["date_of_reg"];
		$gender=$row["gender"];
		$age=$row["age"];
		$marital=$row["marital"];
		$occupation=$row["occupation"];
		$nationality=$row["nationality"];
		$state_of_origin=$row["state_of_origin"];
		
		}
		}else{
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That item does not exit. Please try again with another ID</p>";
		}
		} else {
		$msg= "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No product in the system with that ID</p>";
}
?>
<!doctype html>
<html>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title><?php echo $patient_surname ." " . $patient_firstname. " " . "Profile"; ?></title>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Doctors Unit</li><br>
	  <li><a href="http://10.40.255.5/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="doctors_dashboard.php">Home Page</a></li><br>
	  <li><a href="patient_profile.php">Profile</a></li><br>
	  <li><a href="">Doctor's Note</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
	 <?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo "Doctor" . " " .$name."!"; ?> What would you like to do today?</h1>
  <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'><?php echo "Welcome To" . " " .$patient_surname ." " . $patient_firstname . " " . "Profile Page"; ?></h2>
	 <br>
	<div class="product_details">
	 <table width="480px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Sur Name</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $patient_surname; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>First Name</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $patient_firstname; ?></b></td>
		</tr>
		<tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Other Names</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $patient_lastname; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>Hospital No</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $patient_hos_no; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Date of Birth</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $date_of_birth; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>Age</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $age; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>Date of Registration</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $date_of_reg; ?></b></td>
		</tr>
		<tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Marital</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $marital; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>Occupation</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $occupation; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Nationality</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $nationality; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>State Of origin</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $state_of_origin; ?></b></td>
		</tr>
	    <?php
	    echo $msg;
	    ?>
	 </table><br>
    </div>
	<!-- end .margin --></div>
  <!-- end .container --></div>
 <?php
  include_once "../pharmacySection/footer.php";
  ?>
</body>
</html>
