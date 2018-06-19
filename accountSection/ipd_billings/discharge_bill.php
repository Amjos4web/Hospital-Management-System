<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: ipd_billings_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "../dbconnect2.php";
$sql="SELECT first_name, last_log_date, id FROM `ipd_billings` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["first_name"];
	$date=$row["last_log_date"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<?php
$dynamic_list = "";
$ipd_no = $_SESSION['ipd_no'];
// display the specified drugs information
$display = "SELECT * FROM ipd_billings_form WHERE ipd_no='$ipd_no' LIMIT 1";
$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
$displayResult = mysqli_num_rows($displayCheck);
if ($displayResult > 0){
	while($row=mysqli_fetch_assoc($displayCheck)){
		$ward = $row["ward"];
		$deposit = $row["deposit"];
		$name_2 = $row["name"];
		$unused_drugs = $row["unused_drugs"];
		$amount1=$row["amount1"];
		$amount2=$row["amount2"];
		$amount3=$row["amount3"];
		$amount4=$row["amount4"];
		$amount5=$row["amount5"];
		$amount6=$row["amount6"];
		$amount7=$row["amount7"];
		$amount8=$row["amount8"];
		$amount9=$row["amount9"];
		$amount10=$row["amount10"];
		$amount11=$row["amount11"];
		$amount12=$row["amount12"];
		$amount13=$row["amount13"];
		$amount14=$row["amount14"];
		$amount15=$row["amount15"];
		$amount16=$row["amount16"];
		$amount17=$row["amount17"];
		$amount18=$row["amount18"];
		$amount19=$row["amount19"];
		$amount20=$row["amount20"];
		$amount21=$row["amount21"];
		$amount22=$row["amount22"];
		$amount23=$row["amount23"];
		$amount24=$row["amount24"];
		$amount25=$row["amount25"];
		$amount26=$row["amount26"];
		$amount27=$row["amount27"];
		$amount28=$row["amount28"];
		$amount29=$row["amount29"];
		$amount30=$row["amount30"];
		$amount31=$row["amount31"];
		$amount32=$row["amount32"];
		$amount33=$row["amount33"];
		$amount34=$row["amount34"];
		$amount35=$row["amount35"];
		$amount36=$row["amount36"];
		$amount37=$row["amount37"];
		$amount38=$row["amount38"];
		$amount39=$row["amount39"];
		$amount40=$row["amount40"];
		$amount41=$row["amount41"];
		$amount42=$row["amount42"];
		$amount43=$row["amount43"];
		$amount44=$row["amount44"];
		$amount45=$row["amount45"];
		$amount46=$row["amount46"];
		$amount47=$row["amount47"];
		$amount48=$row["amount48"];
		$amount49=$row["amount49"];
		$amount50=$row["amount50"];
		$amount51=$row["amount51"];
		$amount52=$row["amount52"];
		$amount53=$row["amount53"];
		$amount54=$row["amount54"];
		$amount55=$row["amount55"];
		$amount56=$row["amount56"];
		$amount57=$row["amount57"];
		$amount58=$row["amount58"];
		$amount59=$row["amount59"];
		$amount60=$row["amount60"];
		
	}

	$amount_total = $amount1 + $amount2 + $amount3 + $amount4 + $amount5 + $amount6 + $amount7 + $amount8 + $amount9 + $amount10 + $amount11 + $amount12 + $amount13 + $amount14 + $amount15 + $amount16 + $amount17 + $amount18 + $amount19 + $amount20 + $amount21 + $amount22 + $amount23 + $amount24 + $amount25 + $amount26 + $amount27 + $amount28 + $amount29 + $amount30 + $amount31 + $amount32 + $amount33 + $amount34 + $amount35 + $amount36 + $amount37 + $amount38 + $amount39 + $amount40 + $amount41 + $amount42 + $amount43 + $amount44 + $amount45 + $amount46 + $amount47 + $amount48 + $amount49 + $amount50 + $amount51 + $amount52 + $amount53 + $amount54 + $amount55 + $amount56 + $amount57 + $amount58 + $amount59 + $amount60;
	$credit = $deposit + $unused_drugs;
	if ($credit > $amount_total){
		$balance =  abs($amount_total - $credit). "CR";
	} else {
		$balance =  $amount_total - $credit;
	}
}

// display the specified drugs information
$to_select = "Admission deposit";
$display = "SELECT payment_date, receipt_no1, total_amount, paid_for, pay_date  FROM `transactions` WHERE hospital_no='$ipd_no' AND paid_for='$to_select'";
$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
$displayResult = mysqli_num_rows($displayCheck);
if ($displayResult > 0){
	while($row=mysqli_fetch_assoc($displayCheck)){
		$date2 = $row['payment_date'];
		$receipt_no = $row['receipt_no1'];
		$total_income = $row['total_amount'];
		$paid_for = $row['paid_for'];
		
	
		
		$dynamic_list .= "<tr>";
		$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>" .$date2 . "</td>";
		$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$receipt_no . "</td>";
		$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>".$paid_for . "</td>";
		$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000'>N" .$total_income . "</td>";
		$dynamic_list .= "</tr>";
	
	}
}
$sum = "SELECT  SUM(`total_amount`) AS total_sum1 FROM `transactions` WHERE hospital_no='$ipd_no' AND paid_for='$to_select'";
$sum2 = mysqli_query($dbconnect, $sum) or die (mysqli_error($dbconnect));
$result1 = mysqli_fetch_array($sum2);
$sum_total = $result1['total_sum1'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Discharge Bill for <?php echo $ipd_no; ?></title>
</head>
<body>
<div id="requisition_receipt" style="width: 700px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 18px; font-family: arial black; text-transform: uppercase;">Bowen University Teaching Hospital, Ogbomoso</h1>
<p style="text-align: center; font-family: arial; font-weight: bold; font-size: 17px; text-transform: uppercase; text-decoration: underline;">in patient discharge bill</p>
 <table width="700px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="0">
	<tr>
		<td width="40%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 18px;">Name</label></td>
		<td width="60%"><label style="font-family: Calibri (Body);  margin-left: 70px; font-size: 18px"><?php echo $name_2; ?></label></td>
	</tr>
	<tr>
		<td width="40%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 18px;">Hospital No</label></td>
		<td width="60%"><label style="font-family: Calibri (Body);  margin-left: 70px; font-size: 18px"><?php echo $ipd_no; ?></label></td>
	</tr>
	<tr>
		<td width="40%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 18px;">Ward/Bed</label></td>
		<td width="60%"><label style="font-family: Calibri (Body); margin-left: 70px; font-size: 18px"><?php echo $ward; ?></label></td>
	</tr>
	<tr>
	<tr>
		<td width="40%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 18px;">Confirmed Deposit</label></td>
		<td width="60%"><label style="font-family: Calibri (Body);  margin-left: 70px; font-size: 18px"><?php echo "N" . $deposit; ?></label></td>
	</tr>
		<td width="40%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 18px;">Your total as of</label></td>
		<td width="60%"><label style="font-family: Calibri (Body);  margin-left: 70px; font-size: 18px"><?php echo $date; ?></label></td>
	</tr>
	<tr>
		<td width="40%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 18px;">Total bill is</label></td>
		<td width="60%"><label style="font-family: Calibri (Body);  margin-left: 70px; font-size: 18px"><?php echo "N" . $amount_total; ?></label></td>
	</tr>
	<tr>
		<td width="40%"><label style="font-family: Calibri (Body); font-weight: bold; font-size: 18px;">Less credit for unused drugs</label></td>
		<td width="60%"><label style="font-family: Calibri (Body);  margin-left: 70px; font-size: 18px;"><?php echo "N" .$unused_drugs; ?></label></td>
	</tr>
	</table><br>
	<p style="font-family: arial; font-weight: bold; font-size: 17px; margin-left: 5px;">Less Advance payment made:</p>
	<table width="550px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="0">
   <tr>
	    <td width="22%" style=' font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000; text-transform: uppercase'><b>Date</b></td>
		<td width="26%" style=' font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000; text-transform: uppercase'><b>Receipt No</b></td>
		<td width="26%" style=' font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000; text-transform: uppercase'><b>Paid for</b></td>
		<td width="26%" style=' font-family: arial black; text-align: center; font-size: 14px; border: 1px dashed #000000; text-transform: uppercase'><b>amount n</b></td>
	</tr>
	<?php echo $dynamic_list; ?>
	<!--tr>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	</tr-->
	</table><br>
	<p style="font-family: arial; font-weight: bold; font-size: 17px; float: right; margin-right: 72px; text-decoration: underline">Total: <?php echo "N" . $sum_total; ?></p><br>
	<p style="font-family: arial; font-weight: bold; font-size: 17px; margin-left: 5px;">Total of Advance Payment you are to pay/to receive<br>From the Hospital the balance of:</p>
	<p style="text-align: center; font-family: arial; background-color: #000000; border: 1px solid #CECECE; color: #ffffff; font-weight: bold; font-size: 17px;">Total Amount To Pay: <?php echo "N" . $balance; ?></p><br>
	<label style="font-weight: bold; font-family: arial; font-size: 17px; margin-left: 5px">Account....................................</label><label style="font-weight: bold; font-family: arial; font-size: 17px;"> Billing Officer..............................</label><label style="font-weight: bold; font-family: arial; font-size: 17px;"> Date.......................</label></label><br><br>
	<p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 16px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
