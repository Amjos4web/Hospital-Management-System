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
?>
<?php
$dynamic_list = "";
$dynamic_lists = "";
$intertotal = $_SESSION['intertotal'];
$printtotal = $_SESSION['printtotal'];
$scantotal = $_SESSION['scantotal'];
$traintotal = $_SESSION['traintotal'];
$totalall = $_SESSION['totalall'];
$month = date('F');
if (isset($_GET['from_date']) && ($_GET['to_date'])){
	$from_date = $_GET['from_date']." " . "23:59:59";
	$to_date = $_GET['to_date'];
	
	// parse monthly data into database
		$selectD = "SELECT from_date, to_date FROM digital_income_sum2 WHERE from_date='".$from_date."' AND to_date='".$to_date."' LIMIT 1";
		$checkSelect = mysqli_query($dbconnect, $selectD) or die (mysqli_error($dbconnect));
		$checkResult = mysqli_num_rows($checkSelect);
		if ($checkResult > 0){
			$updateD = "UPDATE digital_income_sum2 SET `month`='".$month."', `from_date`='".$from_date."', `to_date`='".$to_date."', `internet`='".$intertotal."', `printing`='".$printtotal."', `scanning`='".$scantotal."', `training`='".$traintotal."', `total`='".$totalall."' WHERE `from_date`='".$from_date."' AND `to_date`='".$to_date."'  LIMIT 1";
			$checkUpdate = mysqli_query($dbconnect, $updateD) or die (mysqli_error($dbconnect));
		} else {
			$insertD = "INSERT INTO `digital_income_sum2` (`month`, `from_date`, `to_date`, `internet`, `printing`, `scanning`, `training`, `total`) VALUES ('$month', '$from_date', '$to_date', '$intertotal', '$printtotal', '$scantotal', '$traintotal', '$totalall')";
			$checkI = mysqli_query($dbconnect, $insertD) or die (mysqli_error($dbconnect));
		}
		
	// display the specified information
		$display = "SELECT * FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
		$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
		$displayResult = mysqli_num_rows($displayCheck);
		if ($displayResult > 0){
			while($row=mysqli_fetch_assoc($displayCheck)){
				$date = $row['date'];
				$internet = $row['internet'];
				$printing = $row['printing'];
				$scanning = $row['scanning'];
				$training = $row['training'];
				$total = $row['total'];
				
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>" .$date . "</td>";
				$dynamic_list .= "<td style=' text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>".$internet . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>".$printing . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>" .$scanning . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>".$training . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>" .$total . "</td>";
				$dynamic_list .= "</tr>";

				

			}
		} else {
			$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found</p></center>";
		}
	
	// sum total for internet
	$intersum = "SELECT  SUM(`internet`) AS intertotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$intersum2 = mysqli_query($dbconnect, $intersum) or die (mysqli_error($dbconnect));
	$interresult = mysqli_fetch_array($intersum2);
	$intertotal = $interresult['intertotal'];
	
	
	// sum total for printing
	$printsum = "SELECT  SUM(`printing`) AS printtotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$printsum2 = mysqli_query($dbconnect, $printsum) or die (mysqli_error($dbconnect));
	$printresult = mysqli_fetch_array($printsum2);
	$printtotal = $printresult['printtotal'];
	
	// sum total for scanning
	$scansum = "SELECT  SUM(`scanning`) AS scantotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$scansum2 = mysqli_query($dbconnect, $scansum) or die (mysqli_error($dbconnect));
	$scanresult = mysqli_fetch_array($scansum2);
	$scantotal = $scanresult['scantotal'];
	
	// sum total for training
	$trainsum = "SELECT  SUM(`training`) AS traintotal FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$trainsum2 = mysqli_query($dbconnect, $trainsum) or die (mysqli_error($dbconnect));
	$trainresult = mysqli_fetch_array($trainsum2);
	$traintotal = $trainresult['traintotal'];
	
	// sum total for scanning
	$totalsum = "SELECT  SUM(`total`) AS total FROM `digital_income_sum` WHERE `date` >= '$from_date' AND `date` <= '$to_date'";
	$totalsum2 = mysqli_query($dbconnect, $totalsum) or die (mysqli_error($dbconnect));
	$totalresult = mysqli_fetch_array($totalsum2);
	$totalall = $totalresult['total'];

	$dynamic_lists .= "<tr>";
	$dynamic_lists .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000;  font-size: 11px;'>".$intertotal . "</td>";
	$dynamic_lists .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>".$printtotal . "</td>";
	$dynamic_lists .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>" .$scantotal . "</td>";
	$dynamic_lists .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>".$traintotal . "</td>";
	$dynamic_lists .= "<td style='text-align: center; font-family: arial; border: 1px dashed #000000; font-size: 11px;'>" .$totalall . "</td>";
	$dynamic_lists .= "</tr>";
	
}
   

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Monthly Income Summary/Receipt</title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Digital Center</h1>
 <p style="text-align: center; font-size: 14px; font-family: arial">Monthly Income Summary From: <?php echo $from_date; ?> To: <?php echo $to_date; ?> </p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px; margin-left: 20px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <table width="760px" style="margin-left: auto; margin-right: auto;  border: 1px dashed #000000;" cellpadding="0" cellspacing="0" border="1">
	   <tr>
	    <td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Date</b></td>
		<td width="17%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Internet N</b></td>
		<td width="17%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Printing N</b></td>
		<td width="17%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Scanning N</b></td>
		<td width="20%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Training N</b></td>
		<td width="11%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Total N</b></td>
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
		<table width="760px" style="margin-left: auto; margin-right: auto;  border: 1px dashed #000000;" cellpadding="0" cellspacing="0" border="1">
	    <tr>
			<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Internet N</b></td>
			<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Printing N</b></td>
			<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Scanning N</b></td>
			<td width="20%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Training N</b></td>
			<td width="20%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Grand Total N</b></td>
		</tr>
		<?php echo $dynamic_lists; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table>
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 15px"><?php echo "Total" . " " ."=" ." ". $totalall; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
