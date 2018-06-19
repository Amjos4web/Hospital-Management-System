<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

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

$dynamic_list = "";
$dynamic_lists = "";
$onehr = "";
$twohr = "";
$services = "";
$cname = "";
$scancharges = "";
$traincharges = "";
$printcharges = "";
$print = "printing";
$scanning = "scanning";
$training = "training";
$insert_date = date('Y-m-d');
$month = date('F');
$day = date('l');
if (isset($_GET['date'])){
	$date = $_GET['date'];
	
	
	// display the specified drugs information
	$sql2 = "SELECT * FROM `ticket_report` WHERE `date`>='".$date."' ORDER BY `date` DESC";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row=mysqli_fetch_array($check2)){
			$date2=$row["date"];
			if (empty($cname) == true){
				$cname = "Customer";
			} else {
				$cname = $row["cname"];
			}
			$services=$row["services"];
			$onehr=$row["onehr"];
			$twohr=$row["twohr"];
			$staff=$row["staff_name"];
			$charges = $row["charges"];
			$hrn = $row["hospital_rec_no"];
			
			
			$dynamic_lists .= "<tr>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $date2 . "</td>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $cname . "</td>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $services . "</td>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $onehr . "</td>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $twohr . "</td>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $charges . "</td>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $staff."</td>";
			$dynamic_lists .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $hrn."</td>";
			$dynamic_lists .= "</tr>";
			
		}
	} else {
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No earning for today yet</p>";
	}
	
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
	
	$dynamic_list .= "<tr>";
	$dynamic_list .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $onetotal . "</td>";
	$dynamic_list .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $twototal . "</td>";
	$dynamic_list .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $internettotal . "</td>";
	$dynamic_list .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $printtotal . "</td>";
	$dynamic_list .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $scantotal . "</td>";
	$dynamic_list .= "<td style='font-family: Verdana; text-align: center; border: 1px dashed #000000; font-size: 11px;'>" . $traintotal . "</td>";
	$dynamic_list .= "</tr>";
	
	// insert the the total into database
	$select_insert = "SELECT date FROM digital_income_sum WHERE date='".$insert_date."'";
	$checkdate = mysqli_query($dbconnect, $select_insert) or die (mysqli_error($dbconnect));
	$dateresult = mysqli_num_rows($checkdate);
	if ($dateresult == 0){
		$insert = "INSERT INTO digital_income_sum (`month`, `date`, `day`, `internet`, `printing`, `scanning`, `training`, `total`) VALUES ('$month', '$insert_date', '$day', '$internettotal', '$printtotal', '$scantotal', '$traintotal', '$total_amount')";
		$insert_check = mysqli_query($dbconnect, $insert) or die (mysqli_error($dbconnect));
	} else if ($dateresult > 0){
		$update = "UPDATE digital_income_sum SET `month`='$month', `internet`='$internettotal', `day`='$day', `printing`='$printtotal', `scanning`='$scantotal', `training`='$traintotal', `date`='$insert_date', `total`='$total_amount' WHERE `date`='$insert_date'";
		$update_check = mysqli_query($dbconnect, $update) or die (mysqli_error($dbconnect));
	}
	
	
}
   

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Services Income Summary/Receipt</title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Digital Centre</h1>
 <p style="text-align: center; font-size: 14px; font-family: arial">Services Income Summary For <?php echo $date; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px; margin-left: 20px; float: left">Printed on: <?php echo date("l jS \of F "). "," . " " . date('H:i:s'); ?></p>
  <table width="760px" style="margin-left: auto; margin-right: auto;  border: 1px dashed #000000;" cellpadding="0" cellspacing="0" border="1">
	   <tr>
	    <td width="12%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>Date</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>Name</b></td>
		<td width="10%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>Services</b></td>
		<td width="12%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>1Hr</b></td>
		<td width="12%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>2Hrs</b></td>
		<td width="13%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>Charge</b></td>
		<td width="13%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>Staff</b></td>
		<td width="20%" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>H.R.N</b></td>
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
		<table width="760px" style="margin-left: auto; margin-right: auto;  border: 1px dashed #000000;" cellpadding="0" cellspacing="0" border="1">
		<tr>
			<td width="30%" colspan="2" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>Internet</b></td>
			<td width="70%" colspan="4" style='font-family: arial black; text-align: center; font-size: 11px; color: #880000; text-transform: uppercase;'><b>Services</b></td>
		</tr>
	    <tr>
			<td width="14%" style='font-family: arial black; text-align: center; font-size: 11px; border: 1px dashed #000000;'><b>One Hour N</b></td>
			<td width="14%" style='font-family: arial black; text-align: center; font-size: 11px; border: 1px dashed #000000;'><b>Two Hours N</b></td>
			<td width="18%" style='font-family: arial black; text-align: center; font-size: 11px; border: 1px dashed #000000;'><b>Internet N</b></td>
			<td width="18%" style='font-family: arial black; text-align: center; font-size: 11px; border: 1px dashed #000000;'><b>Printing N</b></td>
			<td width="18%" style='font-family: arial black; text-align: center; font-size: 11px; border: 1px dashed #000000;'><b>Scanning N</b></td>
			<td width="18%" style='font-family: arial black; text-align: center; font-size: 11px; border: 1px dashed #000000;'><b>Training N</b></td>
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
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 15px"><?php echo "Total" . " " ."=" ." ". $total_amount; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
