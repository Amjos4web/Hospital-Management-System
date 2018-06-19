<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: revenue_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `revenue_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["first_name"];
	$name2=$row["emailAdd"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<?php
$dynamic_list = "";


if (isset($_GET['from_date']) && ($_GET['to_date'])){
	$from_date = $_GET['from_date'];
	$to_date = $_GET['to_date'];
	$to_filter = $_GET['filter'];

	// display the specified information
	$display = "SELECT * FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' AND `paid_for`='" . $to_filter. "'";
	$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
	$displayResult = mysqli_num_rows($displayCheck);
	if ($displayResult > 0){
		while($row=mysqli_fetch_assoc($displayCheck)){
			$date = $row['payment_date'];
			$receipt_no = $row['receipt_no1'];
			$total_income = $row['total_amount'];
			$paid_for = $row['paid_for'];
			$signed = $row['received_by'];
			
			
			
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$date . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$receipt_no . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$signed . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$paid_for. "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>N" .$total_income . "</td>";
			$dynamic_list .= "</tr>";
		}
	}
	
	// sum for total_amount
	$sum_total = $_SESSION['sum_total'];
	
}
   

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Income Summary for <?php echo $to_filter; ?></title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <p style="text-align: center; font-size: 16px; font-family: arial">Income Summary For <?php echo $to_filter; ?> From: <?php echo $from_date. " "; ?>To:<?php echo " " . $to_date; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 9px; margin-left: 20px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="2" cellspacing="0" border="0">
   <tr>
	   <td width="25%" style=' font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Date</b></td>
		<td width="20%" style=' font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Receipt No</b></td>
		<td width="15%" style=' font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Signed By</b></td>
		<td width="20%" style=' font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Receipt For</b></td>
		<td width="20%" style=' font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Total Income N</b></td>
		</tr>
	<?php echo $dynamic_list; ?>
	<?php echo $msg; ?>
	<!--tr>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	</tr-->
	</table><br>
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 12px"><?php echo "Total:" . " " ."=" ." ". "N" . $sum_total; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 12px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
