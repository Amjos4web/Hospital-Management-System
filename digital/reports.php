<?php 
session_start();
ob_start();
// error display configuration
//error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: user_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../pharmacySection/dbconnect2.php";
$sql="SELECT fname, id FROM `digital_user` WHERE `user_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["fname"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have not logged in yet</p>";
}


// calculate for internet
$dynamic_lists = "";
$dynamic_list = "";
$onehr = "";
$twohr = "";
$services = "";
$cname = "";
$msgscan = "";
$msgprint = "";
$msgtrain = "";
$scancharges = "";
$traincharges = "";
$printcharges = "";
$print = "printing";
$scanning = "scanning";
$training = "training";
$date = date('Y-m-d');	

// sum for one hour
$onesum = "SELECT  SUM(`onehr`) AS one_total FROM `ticket_report` WHERE `date`>='".$date."'";
$onesum2 = mysqli_query($dbconnect, $onesum) or die (mysqli_error($dbconnect));
$oneresult = mysqli_fetch_array($onesum2);
$onetotal = $oneresult['one_total'];

// sum for two hour
$twosum = "SELECT  SUM(`twohr`) AS two_total FROM `ticket_report` WHERE `date`>='".$date."'";
$twosum2 = mysqli_query($dbconnect, $twosum) or die (mysqli_error($dbconnect));
$tworesult = mysqli_fetch_array($twosum2);
$twototal = $tworesult['two_total'];

// sum for printing
$printsum = "SELECT  SUM(`charges`) AS print_total FROM `ticket_report` WHERE `date`>='".$date."' AND `services`='".$print."'";
$printsum2 = mysqli_query($dbconnect, $printsum) or die (mysqli_error($dbconnect));
$printresult = mysqli_fetch_array($printsum2);
$printtotal = $printresult['print_total'];

// sum for scanning
$scansum = "SELECT  SUM(`charges`) AS scan_total FROM `ticket_report` WHERE `date`>='".$date."' AND `services`='".$scanning."'";
$scansum2 = mysqli_query($dbconnect, $scansum) or die (mysqli_error($dbconnect));
$scanresult = mysqli_fetch_array($scansum2);
$scantotal = $scanresult['scan_total'];

// sum for training
$trainsum = "SELECT  SUM(`charges`) AS train_total FROM `ticket_report` WHERE `date`>='".$date."' AND `services`='".$training."'";
$trainsum2 = mysqli_query($dbconnect, $trainsum) or die (mysqli_error($dbconnect));
$trainresult = mysqli_fetch_array($trainsum2);
$traintotal = $trainresult['train_total'];

// sum for all
$total_amount = $onetotal + $twototal + $printtotal + $scantotal + $traintotal;

// sum for internet
$internettotal = $onetotal + $twototal;

$sql2 = "SELECT * FROM `ticket_report` WHERE `date`>='".$date."' ORDER BY `date` DESC";
$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
$resultCount2=mysqli_num_rows($check2); //count the out amount 
if($resultCount2>0){
	while($row=mysqli_fetch_array($check2)){
		$date2=$row["date"];
		$cname = $row["cname"];
		$services=$row["services"];
		$onehr=$row["onehr"];
		$twohr=$row["twohr"];
		$staff=$row["staff_name"];
		$printing = $row["printing"];
		$scanning = $row["scanning"];
		$training = $row["training"];
		$charges = $row["charges"];
		$hrn = $row["hospital_rec_no"];
	
		
		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $date2 . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $cname . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $services . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $onehr . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $twohr . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $charges . "</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $staff."</td>";
		$dynamic_lists .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $hrn."</td>";
		$dynamic_lists .= "</tr>";
	
	}
} else {
	$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No earning for today yet</p>";
}
	
	// // display for printing
	// $sqlprint = "SELECT * FROM `ticket_report` WHERE `date`>='".$date."' AND `services`='".$print."' ORDER BY `date` DESC";
	// $checkprint = mysqli_query($dbconnect, $sqlprint) or die (mysqli_error($dbconnect));
	// $resultCountpr=mysqli_num_rows($checkprint); //count the out amount 
	// if($resultCountpr>0){
		// while($row=mysqli_fetch_array($checkprint)){
			// $dateprint=$row["date"];
			// $cnameprint = $row["cname"];
			// $servicesprint=$row["services"];
			// $staffprint=$row["staff_name"];
			// $chargeprint = $row["charges"];
			
			
			// $dynamic_list2 .= "<tr>";
			// $dynamic_list2 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $dateprint . "</td>";
			// $dynamic_list2 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $cnameprint . "</td>";
			// $dynamic_list2 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $servicesprint . "</td>";
			// $dynamic_list2 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $chargeprint."</td>";
			// $dynamic_list2 .= "</tr>";
		
		// }
	// } else {
		// $msgprint="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No earning for printing yet</p>";
	// }
	
	// // display for scanning
	// $sqlscan = "SELECT * FROM `ticket_report` WHERE `date`>='".$date."' AND `services`='".$scanning."' ORDER BY `date` DESC";
	// $checkscan = mysqli_query($dbconnect, $sqlscan) or die (mysqli_error($dbconnect));
	// $resultCountsc=mysqli_num_rows($checkscan); //count the out amount 
	// if($resultCountsc>0){
		// while($row=mysqli_fetch_array($checkprint)){
			// $datescan=$row["date"];
			// $cnamescan = $row["cname"];
			// $servicescan=$row["services"];
			// $staffscan=$row["staff_name"];
			// $chargescan = $row["charges"];
			
			
			// $dynamic_list3 .= "<tr>";
			// $dynamic_list3 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $datescan . "</td>";
			// $dynamic_list3 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $cnamescan . "</td>";
			// $dynamic_list3 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $servicescan . "</td>";
			// $dynamic_list3 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $chargescan."</td>";
			// $dynamic_list3 .= "</tr>";
		
		// }
	// } else {
		// $msgscan="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No earning for scanning yet</p>";
	// }
	
	// // display for training
	// $sqltrain = "SELECT * FROM `ticket_report` WHERE `date`>='".$date."' AND `services`='".$training."' ORDER BY `date` DESC";
	// $checktrain = mysqli_query($dbconnect, $sqltrain) or die (mysqli_error($dbconnect));
	// $resultCounttr=mysqli_num_rows($checktrain); //count the out amount 
	// if($resultCountsc>0){
		// while($row=mysqli_fetch_array($checktrain)){
			// $datetr=$row["date"];
			// $cnametr = $row["cname"];
			// $servicetr=$row["services"];
			// $stafftr=$row["staff_name"];
			// $chargetr = $row["charges"];
			
			
			
			// $dynamic_list4 .= "<tr>";
			// $dynamic_list4 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $datetr . "</td>";
			// $dynamic_list4 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $cnametr . "</td>";
			// $dynamic_list4 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $servicetr . "</td>";
			// $dynamic_list4 .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $chargetr."</td>";
			// $dynamic_list4 .= "</tr>";
		
		// }
	// } else {
		// $msgtrain="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No earning for training yet</p>";
	// }

		$dynamic_list .= "<tr>";
		$dynamic_list .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $onetotal . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $twototal . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $printtotal . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $scantotal . "</td>";
		$dynamic_list .= "<td style='background-color:#CECECE; font-family: Verdana; text-align: center;'>" . $traintotal . "</td>";
		$dynamic_list .= "</tr>";
?>
<!doctype html>
<html>
<head>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Buth Digital Center</title>
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
	  <li><a href="digital_home.php">Homepage</a></li><br>
	  <li><a href="reports.php">Today's Report</a></li><br>
	  <li><a href="logout.php">Logout</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
	     <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>ict/digital center daily report sheet<h3>
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace; text-transform: uppercase;'>Report for <?php echo date('Y-m-d'); ?><h3>
	    </div><br>
	  <div class="product_formlist">
	  <?php echo $msg; ?>
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="1">
	   <tr>
	    <td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Date</b></td>
		<td width="15%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Name</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Services</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>1Hr</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>2Hrs</b></td>
		<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Charges</b></td>
		<td width="13%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Staff</b></td>
		<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>H.R.N</b></td>
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
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="0">
		<tr>
			<td width="100%" colspan="5" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 16px; color: #880000; text-transform: uppercase;'><b>Services</b></td>
		</tr>
	    <tr>
			<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>One Hour N</b></td>
			<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Two Hours N</b></td>
			<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Printing N</b></td>
			<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Scanning N</b></td>
			<td width="20%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Training N</b></td>
		</tr>
		<?php echo $dynamic_list; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br><br>
	   </div><br>
	   <center><h3 class="heading_text">Total Services Income for <?php echo $date; ?></h3></center>
	<center><input name="expt_profit" class="userarea0" type="text" value="<?php echo "=N".$total_amount; ?>"  style="width: 150px; text-align: center; background-color: #082944; color: #FFFFFF" disabled="disabled"></center><br>
   <form action="report_receipt.php?date=$date" method="GET" id="jsform" target="_blank">
		<input type="hidden" name="date" value="<?php echo $date; ?>">
		<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print Report Sheet"></center>
  </form>
   <!-- end .content --></div>
  <!-- end .container --></div>
     <?php
      include_once "../pharmacySection/footer.php";
     ?>
</body>
</html>