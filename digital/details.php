<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: index.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../pharmacySection/dbconnect2.php";
$sql="SELECT fname, id FROM `digital_admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["fname"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have not log in yet</p>";
}

// check the url is set and exit in the database

if ((isset($_GET['staffid'])) && (isset($_GET['date']))){
	$staffid = $_GET['staffid'];
	$date = $_GET['date'];
	// use this var to check if the ID exist in the database, if yes, show the staff details, if no
	// give message
	$select = "SELECT * FROM internet_enquiry WHERE staff_id='".$staffid."' AND date_of_sub='".$date."' LIMIT 1";
	$checkticket = mysqli_query($dbconnect, $select) or die (mysqli_error($dbconnect));
	$ticketresult = mysqli_num_rows($checkticket);
	if ($ticketresult > 0)
	{
		while ($row=mysqli_fetch_array($checkticket))
		{
			$date = $row['date_of_sub'];
			$fn = $row['firstName'];
			$ln = $row['lastName'];
			$mn = $row['middleName'];
			$depart = $row['department'];
			$phone = $row['phoneNo'];
			$email = $row['emailAdd'];
			$comment = $row['comment'];
			$issue = $row['issue'];
		}
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Nothing to display</p>";
	}
}
if (isset($_POST['fix'])){
	$status1 = 'Fixed' . ' ' . 'by' . ' ' . $name;
	// use this var to check if the ID exist in the database, if yes, show the staff details, if no
	// give message
	$update = "SELECT `status`, `date_of_sub` FROM internet_enquiry WHERE `staff_id`='".$staffid."' AND date_of_sub='".$date."' LIMIT 1";
	$check = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
	$checkstatus = mysqli_num_rows($check);
	if ($checkstatus > 0)
	{
		while ($row=mysqli_fetch_array($check))
		{
			$status = $row['status'];
		}
		
		$updatestatus = "UPDATE internet_enquiry SET `status`='".$status1."' WHERE staff_id='".$staffid."' AND date_of_sub='".$date."' LIMIT 1";
		$checkupdate = mysqli_query($dbconnect, $updatestatus) or die (mysqli_error($dbconnect));
		header('location: enquiryForms.php');
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No earning for today yet</p>";
	}
	
}

?>
<!doctype html>
<html>
<head>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>ICT/Digital Centre Issue Details</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "../pharmacySection/header.php";
?>
<div id="container">
	<div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <li class="page_title">Digital Center</li><br>
	  <li><a href="index.php">Homepage</a></li><br>
	  <li><a href="admin_report.php">Today's Report</a></li><br>
	  <li><a href="monthly_income.php">Monthly Income</a></li><br>
	  <li><a href="yearly_income.php">Yearly Income</a></li><br>
	  <li><a href="enquiryForms.php">Issues</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
	     <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>
	     ICT/Digital Centre Issue Details
	     <h3>
	   </div><br>
   <?php echo $msg; ?>
	<div class="product_details">
	<form action="" method="POST">
	 <table width="430px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Staff ID</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $staffid; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Names</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $fn . " " . $ln . " " . $mn; ?></b></td>
		</tr>
		<tr class="reli">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Department</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $depart; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Phone No</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $phone; ?></b></td>
		</tr>
		<tr class="marital">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Email Address</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $email; ?></b></td>
		</tr>
		<tr class="maiden">
	    <td width="50%" style='background-color:#C5DFFA; font-family: Arial; padding-left: 20px; font-size: 14px'><b>Issue(s)</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: monospace; padding-left: 20px; font-size: 14px'><b><?php echo $comment; ?></b></td>
		</tr>
		</table><br>
		<center><input type="submit" value="Fix This" name="fix" class="submit4"></center>
		</form>
	 </div>
	<!-- end .margin --></div>
  <!-- end .container --></div>
 <?php
  include_once "../pharmacySection/footer.php";
  ?>
</body>
</html>
