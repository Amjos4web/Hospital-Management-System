<?php 
session_start();
ob_start();
include "searchQuery.php";
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
?>
<!doctype html>
<html>
<link href="../pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Patient Search Results</title>
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
	  <div id="patient_form">
	  	<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="1">
		<tr>
			<td width="27%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
			<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Hosp. No</b></td>
			<td width="17%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Phone No</b></td>
			<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Gender</b></td>
			<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Details</b></td>
			<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Forward</b></td>
		</tr>
		<?php echo $patient_search_results; ?>
	    <?php echo $msg2; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table>
	  </div><br><br>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
	 <?php
	  include_once "../pharmacySection/footer.php";
	 ?>
</body>
</html>