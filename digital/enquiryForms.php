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

$dynamic_lists = "";
$sort = date("F");

$select = "SELECT * FROM internet_enquiry WHERE month='".$sort."' ORDER BY `date_of_sub` DESC";
$checkticket = mysqli_query($dbconnect, $select) or die (mysqli_error($dbconnect));
$ticketresult = mysqli_num_rows($checkticket);
if ($ticketresult > 0)
{
	while ($row=mysqli_fetch_array($checkticket))
	{
		$date = $row['date_of_sub'];
		$staffid = $row['staff_id'];
		$fn = $row['firstName'];
		$ln = $row['lastName'];
		$mn = $row['middleName'];
		$depart = $row['department'];
		$phone = $row['phoneNo'];
		$email = $row['emailAdd'];
		$comment = $row['comment'];
		$issue = $row['issue'];
		$status = $row['status'];
		
		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $date . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $fn . " " . $ln . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $depart . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $phone . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $issue."</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $status."</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; text-align: center;'><a href='details.php?staffid=".$staffid."&date=".$date."' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>View Details</a></td>";
		$dynamic_lists .= "</tr>";
	}
} else {
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Nothing to display</p>";
}

?>
<!doctype html>
<html>
<head>
<link href="http://10.40.255.5/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>BUTH Digital Centre Issues Reporting Sheet</title>
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
	     <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>ICT/Digital Centre Monthly Issues Reporting Sheet</div><br>
	  <div class="product_formlist">
	  <?php echo $msg; ?>
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="1">
	    <tr>
	    <td width="15.5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Date</b></td>
		<td width="17%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Names</b></td>
		<td width="12.5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Depart.</b></td>
		<td width="12.5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Phone</b></td>
		<td width="12.5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Issue</b></td>
		<td width="17.5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Status</b></td>
		<td width="12.5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Details</b></td>
		</tr>
		<?php echo $dynamic_lists; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
		
	   </div>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>