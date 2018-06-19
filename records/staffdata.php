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
	$sql6 = "SELECT * FROM staff_record LEFT JOIN staff_record2 ON staff_record.staff_id=staff_record2.staff_id WHERE staff_record.staff_id='".$hospital_no."' LIMIT 1";
	$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
	$resultCount6 = mysqli_num_rows($check6);
	if ($resultCount6>0){
		while($row=mysqli_fetch_array($check6)){
			$surname=$row["surName"];
			$firstname=$row["firstName"];
			$othername=$row["otherName"];
			$sex=$row["sex"];
			$religion=$row["religion"];
			$phoneNo=$row["phoneNo"];
			$job_title=$row["job_title"];
			$job_des=$row["job_des"];
			$depart=$row["department"];
			$unit=$row["unit"];
			$salary_level=$row["salary_level"];
			$marital=$row["marital"];
			$dateofbirth=$row["DateofBirth"];
			$nationality=$row["natioNality"];
			$state=$row["stateoforigin"];
			$hometown=$row["homeTown"];
			$lga=$row["LGA"];
			$denoMination=$row["unit"];
			$postaladdress=$row["postaladdress"];
			$rs=$row["resumption_date"];
			$mn=$row["maidenName"];
			$religion=$row["religion"];
			$ha=$row["homeAddress"];
			$deno=$row["denoMination"];
			$postal=$row["postaladdress"];
			$kinname=$row["Nameofkin"];
			$kinphone=$row["phoneNo1"];
			$rela=$row["relationship1"];
			$add=$row["address1"];
			$school1 = $row["school1"];
			$from1 = $row["from1"];
			$to1 = $row["to1"];
			$school2 = $row["school2"];
			$from2 = $row["from2"];
			$to2 = $row["to2"];
			$school3 = $row["school3"];
			$from3 = $row["from3"];
			$to3 = $row["to3"];
			$school4 = $row["school4"];
			$from4 = $row["from4"];
			$to4 = $row["to4"];
			$school5 = $row["school5"];
			$from5 = $row["from5"];
			$to5 = $row["to5"];
			$cert1 = $row["cert1"];
			$cert2 = $row["cert2"];
			$cert3 = $row["cert3"];
			$cert4 = $row["cert4"];
			$cert5 = $row["cert5"];
			$other_school1 = $row["other_schools1"];
			$other_year1 = $row["other_year1"];
			$other_cert1 = $row["other_cert1"];
			$other_school2 = $row["other_schools2"];
			$other_year2 = $row["other_year2"];
			$other_cert2 = $row["other_cert2"];
			$other_school3 = $row["other_schools3"];
			$other_year3 = $row["other_year3"];
			$other_cert3 = $row["other_cert3"];
			$other_school4 = $row["other_schools4"];
			$other_year4 = $row["other_year4"];
			$other_cert4 = $row["other_cert4"];
			$other_school5 = $row["other_schools5"];
			$other_year5 = $row["other_year5"];
			$other_cert5 = $row["other_cert5"];
			$dis1 = $row["dis1"];
			$int1 = $row["inte1"];
			$dis2 = $row["dis2"];
			$int2 = $row["inte2"];
			$dis3 = $row["dis3"];
			$int3 = $row["inte3"];
			$dis4 = $row["dis4"];
			$int4 = $row["inte4"];
			
			if ($mn == "Null" || $mn == ""){
				?><style type="text/css">.maiden{
					display: none;
				}
				</style><?php
			}
			if ($religion == "Null" || $religion == ""){
				?><style type="text/css">.reli{
					display: none;
				}
				</style><?php
			}
			if ($deno == "Null" || $deno == ""){
				?><style type="text/css">.deno{
					display: none;
				}
				</style><?php
			}
			if ($postal == "Null" || $postal == ""){
				?><style type="text/css">.postal{
					display: none;
				}
				</style><?php
			}
			if ($marital == "Null" || $marital == ""){
				?><style type="text/css">.marital{
					display: none;
				}
				</style><?php
			}
			if ($ha == "Null" || $ha == ""){
				?><style type="text/css">.hom{
					display: none;
				}
				</style><?php
			}
			if ($school1 == "" || $from1 == "Null" || $to1 == "Null" || $cert1 == "Null"){
				?><style type="text/css">.school1{
					display: none;
				}
				.year1{
					display: none;
				}
				.cert1{
					display: none;
				}
				</style><?php
			}
			if ($school2 == "" || $from2 == "Null" || $to2 == "Null" || $cert2 == "Null"){
				?><style type="text/css">.school2{
					display: none;
				}
				.year2{
					display: none;
				}
				.cert2{
					display: none;
				}
				</style><?php
			}
			if ($school3 == "" || $from3 == "Null" || $to3 == "Null" || $cert3 == "Null"){
				?><style type="text/css">.school3{
					display: none;
				}
				.year3{
					display: none;
				}
				.cert3{
					display: none;
				}
				</style><?php
			}
			if ($school4 == "" || $from4 == "Null" || $to4 == "Null" || $cert4 == "Null"){
				?><style type="text/css">.school4{
					display: none;
				}
				.year4{
					display: none;
				}
				.cert4{
					display: none;
				}
				</style><?php
			}
			if ($school5 == "" || $from5 == "Null" || $to5 == "Null" || $cert5 == "Null"){
				?><style type="text/css">.school5{
					display: none;
				}
				.year5{
					display: none;
				}
				.cert5{
					display: none;
				}
				</style><?php
			}
			if ($other_school1 == "" || $other_year1 == "Null" || $other_cert1 == ""){
				?><style type="text/css">.oschool1{
					display: none;
				}
				.oyear1{
					display: none;
				}
				.ocert1{
					display: none;
				}
				</style><?php
			}
			if ($other_school2 == "" || $other_year2 == "Null" || $other_cert2 == ""){
				?><style type="text/css">.oschool2{
					display: none;
				}
				.oyear2{
					display: none;
				}
				.ocert2{
					display: none;
				}
				</style><?php
			}
			if ($other_school3 == "" || $other_year3 == "Null" || $other_cert3 == ""){
				?><style type="text/css">.oschool3{
					display: none;
				}
				.oyear3{
					display: none;
				}
				.ocert3{
					display: none;
				}
				</style><?php
			}
			if ($other_school4 == "" || $other_year4 == "Null" || $other_cert4 == ""){
				?><style type="text/css">.oschool4{
					display: none;
				}
				.oyear4{
					display: none;
				}
				.ocert4{
					display: none;
				}
				</style><?php
			}
			if ($other_school5 == "" || $other_year5 == "Null" || $other_cert5 == ""){
				?><style type="text/css">.oschool5{
					display: none;
				}
				.oyear5{
					display: none;
				}
				.ocert5{
					display: none;
				}
				</style><?php
			}
			if ($dis1 == ""){
				?><style type="text/css">.dis1{
					display: none;
				}
				</style><?php
			}
			if ($dis2 == ""){
				?><style type="text/css">.dis2{
					display: none;
				}
				</style><?php
			}
			if ($dis3 == ""){
				?><style type="text/css">.dis3{
					display: none;
				}
				</style><?php
			}
			if ($dis4 == ""){
				?><style type="text/css">.dis4{
					display: none;
				}
				</style><?php
			}
			if ($int1 == ""){
				?><style type="text/css">.int1{
					display: none;
				}
				</style><?php
			}
			if ($int2 == ""){
				?><style type="text/css">.int2{
					display: none;
				}
				</style><?php
			}
			if ($int3 == ""){
				?><style type="text/css">.int3{
					display: none;
				}
				</style><?php
			}
			if ($int4 == ""){
				?><style type="text/css">.int4{
					display: none;
				}
				</style><?php
			}
			
		
		}
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That staff does not exit. Please try again with another ID</p>";
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
	  <!--<div id="personalty">
	    <ul>
		  <li id="gen"><a href="#">Hospital Data</a></li>
		  <li id="staff"><a href="#">Diagnosis</a></li>
		  <li id="sem"><a href="#">Operation</a></li>
		  <li id="nhis"><a href="#">Doctors' Comments</a></li>
	    </ul>
	  </div>-->
	  <div class="product_details">
	<center><h3 class="heading_text" style="width: 400px">Bio Data</h3></center><br>
	 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Staff Id</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $hospital_no; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Surname</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $surname; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>First Name</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $firstname; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Other Names</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $othername; ?></b></td>
		</tr>
		<tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Sex</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $sex; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Date Of Birth</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $dateofbirth; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Phone No</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $phoneNo; ?></b></td>
		</tr>
		<tr class="reli">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Religion</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $religion; ?></b></td>
		</tr>
		<tr class="marital">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Marital Status</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $marital; ?></b></td>
		</tr>
		<tr class="maiden">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Maiden Name</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $mn; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Nationality</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $nationality; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Home Town</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $hometown; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Local Gov. Area</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $lga; ?></b></td>
		</tr>
		<tr class="home">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Home Address</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $ha; ?></b></td>
		</tr>
		<tr class="deno">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Denomination</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $deno; ?></b></td>
		</tr>
		<tr class="postal">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Postal Address</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $postal; ?></b></td>
		</tr>
		</table><br>
		<center><h3 class="heading_text" style="width: 400px">Office information</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Job Title</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $job_title; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Job Description</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $job_des; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Department</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $depart; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Unit</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $unit; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Salary level</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $salary_level; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Resumption Date</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $rs; ?></b></td>
		</tr>
	 </table><br>
	 <center><h3 class="heading_text" style="width: 400px">Next of kin</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Next Of Kin</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $kinname; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Phone No</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $kinphone; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Relationship</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $rela; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Address</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $add; ?></b></td>
		</tr>
	 </table><br>
	  <center><h3 class="heading_text" style="width: 400px">Education background</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr class="school1">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 1</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $school1; ?></b></td>
		</tr>
		<tr class="year1">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from1. " " . "To" . $to1; ?></b></td>
		</tr>
		<tr class="cert1">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $cert1; ?></b></td>
		</tr>
		<tr class="school2">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 2</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $school2; ?></b></td>
		</tr>
		<tr class="year2">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial;  padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from2. " " . "To" . $to2; ?></b></td>
		</tr>
		<tr class="cert2">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $cert2; ?></b></td>
		</tr>
		<tr class="school3">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 3</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $school3; ?></b></td>
		</tr>
		<tr class="year3">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from3. " " . "To" . $to3; ?></b></td>
		</tr>
		<tr class="cert3">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $cert3; ?></b></td>
		</tr>
		<tr class="school4">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 4</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $school4; ?></b></td>
		</tr>
		<tr class="year4">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from4. " " . "To" . $to4; ?></b></td>
		</tr>
		<tr class="cert4">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $cert4; ?></b></td>
		</tr>
		<tr class="school5">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>School Attended 5</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $school5; ?></b></td>
		</tr>
		<tr class="year5">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo "From" . " " . $from5. " " . "To" . $to5; ?></b></td>
		</tr>
		<tr class="cert5">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $cert5; ?></b></td>
		</tr>
	 </table><br>
	 <center><h3 class="heading_text" style="width: 400px">Education background/other bodies</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr class="oschool1">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Name Of Body 1</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_school1; ?></b></td>
		</tr>
		<tr class="oyear1">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_year1; ?></b></td>
		</tr>
		<tr class="ocert1">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_cert1; ?></b></td>
		</tr>
		<tr class="oschool2">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Name Of Body 2</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_school2; ?></b></td>
		</tr>
		<tr class="oyear2">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_year2; ?></b></td>
		</tr>
		<tr class="ocert2">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_cert2; ?></b></td>
		</tr>
		<tr class="oschool3">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Name Of Body 3</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_school3; ?></b></td>
		</tr>
		<tr class="oyear3">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_year3; ?></b></td>
		</tr>
		<tr class="ocert3">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_cert3; ?></b></td>
		</tr>
		<tr class="oschool4">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Name Of Body 4</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_school4; ?></b></td>
		</tr>
		<tr class="oyear4">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_year4; ?></b></td>
		</tr>
		<tr class="ocert4">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_cert4; ?></b></td>
		</tr>
		<tr class="oschool5">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Name Of Body 5</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_school5; ?></b></td>
		</tr>
		<tr class="oyear5">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Year</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_year5; ?></b></td>
		</tr>
		<tr class="ocert5">
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Certificate Received</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $other_cert5; ?></b></td>
		</tr>
		</table><br>
	 <center><h3 class="heading_text" style="width: 400px">Discipline and other interests</h3></center><br>
			 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
				<tr class="dis1">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Discipline 1</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $dis1; ?></b></td>
				</tr>
				<tr class="int1">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Other Interest</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $int1; ?></b></td>
				</tr>
				<tr class="dis2">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Discipline 2</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $dis1; ?></b></td>
				</tr>
				<tr class="int2">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Other Interest</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $int2; ?></b></td>
				</tr>
				<tr class="dis3">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Discipline 3</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $dis3; ?></b></td>
				</tr>
				<tr class="int3">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Other Interest</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $int3; ?></b></td>
				</tr>
				<tr class="dis4">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px;  font-size: 14px'><b>Discipline 4</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $dis4; ?></b></td>
				</tr>
				<tr class="int4">
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Other Interest</b></td>
				<td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b><?php echo $int4; ?></b></td>
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