<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: rec_staff.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `record_staff` WHERE `rec_staff_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["rec_staff_pass"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

if (isset($_GET['hospital_no'])){
	$hospital_no = $_GET['hospital_no'];
	// use this var to check if the ID exist in the database, if yes, show the staff details, if no
	// give message
	$sql6 = "SELECT * FROM patient_rec WHERE hosp_no='".$hospital_no."' LIMIT 1";
	$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
	$resultCount6 = mysqli_num_rows($check6);
	if ($resultCount6>0){
		while($row=mysqli_fetch_array($check6)){
			$hospital_no=$row["hosp_no"];
			$sn=$row["sur_name"];
			$fn=$row["first_name"];
			$on=$row["other_names"];
			$gender=$row["gender"];
			$dob=$row["date_of_birth"];
			$age=$row["age"];
			$dor=$row["date_of_reg"];
			$marital=$row["marital"];
			$occu=$row["occupation"];
			$noe=$row["nameAddOfEmp"];
			$nationality=$row["nationality"];
			$sor=$row["state_of_origin"];
			$phone=$row["phone_no"];
			$localgov=$row["local_gov"];
			$ht=$row["home_town"];
			$r=$row["religion"];
			$ra=$row["res_add"];
			$nokn=$row["next_of_kinName"];
			$nokr=$row["next_of_kinRel"];
			$noka=$row["next_of_kinAdd"];
			$nokp=$row["next_of_kinPhn"];
			$xray=$row["x-ray_no"];
		}
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That patient does not exit. Please try again with another ID</p>";
	}
} else {
	$msg= "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No patient in the system with that ID</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Patient Search Results</title>
<script src="../pharmacySection/js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
	<p class="subHeader">Menu</p>
	<ul id="navigation2">
	  <li class="page_title">Records Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Main Page</a></li><br>
	  <li><a href="rec_new_client.php">New Patient</a></li><br>
	  <li><a href="rec_returning_patient.php">Find Patient</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
	<?php include_once "../new_bar.php"; ?>
	  <!-- end .sidebar1 --></div>
	 <div class="margin" id="content">
	  <div id="personalty">
	    <ul>
		 <li id="gen"><a href="hospitalData.php?hospital_no=<?php echo $hospital_no; ?>">Hospital Data</a></li>
		  <li id="staff"><a href="diagnosis.php?hospital_no=<?php echo $hospital_no; ?>">Diagnosis</a></li>
		  <li id="sem"><a href="operations.php?hospital_no=<?php echo $hospital_no; ?>">Operation</a></li>
		  <li id="nhis"><a href="comments.php?hospital_no=<?php echo $hospital_no; ?>">Doctors' Comments</a></li>
		  <li id="vital"><a href="vitalsign.php?hospital_no=<?php echo $hospital_no; ?>">Vital Sign</a></li>
	    </ul>
	  </div><br><br>
	  <div class="product_details">
	<center><h3 class="heading_text" style="width: 400px">Bio Data</h3></center><br>
	 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Hospital No</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $hospital_no; ?></b></td>
		</tr>
		<tr>
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Surname</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $sn; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>First Name</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $fn; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Other Names</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $on; ?></b></td>
		</tr>
		<tr>
		<tr>
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Sex</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $gender; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Date Of Birth</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $dob; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Age</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $age; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Date Of Registration</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $dor; ?></b></td>
		</tr>
		<tr>
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Phone No</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $phone; ?></b></td>
		</tr>
		<tr class="reli">
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Religion</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $r; ?></b></td>
		</tr>
		<tr class="marital">
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Marital Status</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $marital; ?></b></td>
		</tr>
		<tr class="">
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Occupation</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $occu; ?></b></td>
		</tr>
		<tr class="">
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Name and address of employee</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $marital; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Nationality</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $nationality; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Home Town</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $ht; ?></b></td>
		</tr>
		<tr>
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Local Gov. Area</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $localgov; ?></b></td>
		</tr>
		<tr class="home">
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Residential Address</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $ra; ?></b></td>
		</tr>
		</table><br>
		<center><h3 class="heading_text" style="width: 400px">Next of kin</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Next Of Kin</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $nokn; ?></b></td>
		</tr>
		<tr>
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Phone No</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $nokp; ?></b></td>
		</tr>
		<tr>
		<td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Relationship</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $nokr; ?></b></td>
		</tr>
		<tr>
	    <td width="40%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Address</b></td>
		<td width="60%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $noka; ?></b></td>
		</tr>
	 </table><br>
	 </div>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	 <?php
	  include_once "../pharmacySection/footer.php";
	 ?>
</body>
</html>