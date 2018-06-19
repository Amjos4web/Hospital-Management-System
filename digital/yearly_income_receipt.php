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

$dynamic_list = "";
$internet = "";
$printing = "";
$scanning = "";
$training = "";
$grandtotal = "";
$year = "";
if (isset($_GET['year']))
{
	$year = $_GET['year'];
	// display the specified information
	$display = "SELECT * FROM `digital_income_sum2` WHERE `date` LIKE '%$year%'";
	$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
	$displayResult = mysqli_num_rows($displayCheck);
	if ($displayResult > 0){
		while($row=mysqli_fetch_assoc($displayCheck)){
			$month = $row['month'];
			$internet = $row['internet'];
			$printing = $row['printing'];
			$scanning = $row['scanning'];
			$training = $row['training'];
			$total = $row['total'];
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='text-align: center; font-family: arial; font-size: 11px;'>".$month . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: arial; font-size: 11px;'>".$internet . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: arial; font-size: 11px;'>".$printing . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: arial; font-size: 11px;'>" .$scanning . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: arial; font-size: 11px;'>".$training . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: arial; font-size: 11px;'>" .$total . "</td>";
			$dynamic_list .= "</tr>";
		}
	} else {
		$msg="<center><p style = 'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 400px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase; padding-left: 12px'>No result found for $year</p></center>";
	}
	
	$grandtotal = $internet + $printing + $scanning + $training;
}
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Yearly Income Summary/Receipt</title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Digital Center</h1>
 <p style="text-align: center; font-size: 14px; font-family: arial">Yearly Income Summary For <?php echo $year; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px; margin-left: 20px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <table width="760px" style="margin-left: auto; margin-right: auto;  border: 1px dashed #000000;" cellpadding="0" cellspacing="0" border="1">
	   <tr>
	    <td width="20%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Month</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Internet N</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Printing N</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Scanning N</b></td>
		<td width="20%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Training N</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 14px; font-size: 11px;'><b>Total N</b></td>
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
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 15px"><?php echo "Total" . " " ."=" ." ". $grandtotal; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By BUTH ICT</p>
	</div>
  </body>
 </html>
