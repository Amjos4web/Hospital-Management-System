<?php 
session_start();
ob_start();
// error display configuration
if(!isset($_SESSION['emaill'])){
	header('location: pharmacy_store.php');
}
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `pharmacy_store` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<?php
$dynamic_list = "";
$dynamic_lists = "";

if (isset($_GET['from_date']) && ($_GET['to_date'])){
	$from_date = $_GET['from_date'];
	$to_date = $_GET['to_date'];
	$paid_for = $_GET['paid_for'];
	
		// display the specified drugs information
		$display = "SELECT * FROM `transactions` WHERE `payment_date` >= '$from_date' AND `payment_date` <= '$to_date' && `paid_for`='$paid_for'";
		$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
		$displayResult = mysqli_num_rows($displayCheck);
		if ($displayResult > 0){
			while($row=mysqli_fetch_assoc($displayCheck)){
		
				$payment_date = $row['payment_date'];
				$hosp_no = $row['hospital_no'];
				$patient_name = $row['patient_name'];
				$total_income = $row['total_amount'];
				$payment_status = $row['payment_status'];
				$billed_by = $row['staff_id'];
				
				
				$dynamic_list .= "<tr>";
				$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$payment_date . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$hosp_no . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$patient_name . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$total_income . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$payment_status . "</td>";
				$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>". $billed_by . "</td>";
				$dynamic_list .= "</tr>";
			
			// sum for total_amount
			 $total_amount = $_SESSION['total_amount'];
			
			// sum paid
			 $total_amount1 = $_SESSION['total_amount1'] ;
			
			// sum unpaid
			 $total_amount2 = $_SESSION['total_amount2'];
			
			
		}
		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$total_amount1. "</td>";
		$dynamic_lists .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$total_amount2. "</td>";
		$dynamic_lists .= "</tr>";
	}
}
   

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Income Summary/Receipt</title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 18px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <p style="text-align: center; font-size: 16px; font-family: arial">Income Summary From: <?php echo $from_date. " "; ?>To:<?php echo " " . $to_date; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 9px; margin-left: 20px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="0">
   <tr>
	    <td width="18%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Payment Date</b></td>
		<td width="18%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Hosp. No</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Patient Name</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Expected Income N</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Payment Status</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Billed By</b></td>
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
	<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="0">
	   <tr>
	    <td width="50%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Total Income For Paid N</b></td>
		<td width="50%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Total Income For Unpaid N</b></td>
		
		</tr>
		<?php echo $dynamic_lists; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table><br>
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 9px"><?php echo "Total" . " " ."=" ." ". $total_amount; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 9px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
