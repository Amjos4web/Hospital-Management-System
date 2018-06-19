<?php
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: cashier_login.php');
}

// error configuration
// error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql = "SELECT * FROM `cashier` WHERE `username_id`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));;
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$firstname=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// pass the data into the database
$discount = $_POST['discount'];
$received = $_POST['received'];
$being_pay_for = trim($_POST['being_pay_for']);
$others = trim($_POST['others']);
$amount_to_pay = $_POST['amount_to_pay'];
$amount_to_pay = preg_replace("#[^0-9.,]#i", "",$_POST['amount_to_pay']);
$hosp_no = $_POST['hosp_no'];
$amount_collected = $_POST['amount_collected'];
$amount_collected = preg_replace("#[^0-9.,]#i", "",$_POST['amount_collected']);
$payment_date = date('Y-m-d H:i:s');
$payment = "paid";
$tran_id1 = date('ym') . "000";




if (empty($received & $amount_to_pay & $amount_collected) == false)
{
	if ($_POST['discount'] == "Full Payment"){
		$discountToInsert = "0";
		$discountOff = "No Discount";
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `amount_tendered`, `discount`, `discountOff`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amount_to_pay', '$amount_to_pay', '$amount_collected', '$discountOff', '$discountToInsert', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();
		 
	} else if  ($_POST['discount'] == "5% Payment"){
		$percentage = "0.05";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "95% Discount";
		// calculate discount to insert
		$disPer = "0.95";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "10% Payment"){
		$percentage = "0.1";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "90% Discount";
		// calculate discount to insert
		$disPer = "0.9";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "15% Payment"){
		$percentage = "0.15";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "85% Discount";
		// calculate discount to insert
		$disPer = "0.85";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "20% Payment"){
		$percentage = "0.2";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "80% Discount";
		// calculate discount to insert
		$disPer = "0.8";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "25% Payment"){
		$percentage = "0.25";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "75% Discount";
		// calculate discount to insert
		$disPer = "0.75";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "30% Payment"){
		$percentage = "0.3";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "70% Discount";
		// calculate discount to insert
		$disPer = "0.7";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "35% Payment"){
		$percentage = "0.35";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "65% Discount";
		// calculate discount to insert
		$disPer = "0.65";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "40% Payment"){
		$percentage = "0.4";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "60% Discount";
		// calculate discount to insert
		$disPer = "0.6";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "45% Payment"){
		$percentage = "0.45";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "55% Discount";
		// calculate discount to insert
		$disPer = "0.55";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "50% Payment"){
		$percentage = "0.5";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "50% Discount";
		// calculate discount to insert
		$disPer = "0.5";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "55% Payment"){
		$percentage = "0.55";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "45% Discount";
		// calculate discount to insert
		$disPer = "0.45";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "60% Payment"){
		$percentage = "0.6";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "40% Discount";
		// calculate discount to insert
		$disPer = "0.4";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "65% Payment"){
		$percentage = "0.65";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "35% Discount";
		// calculate discount to insert
		$disPer = "0.35";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "70% Payment"){
		$percentage = "0.7";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "30% Discount";
		// calculate discount to insert
		$disPer = "0.3";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "75% Payment"){
		$percentage = "0.75";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "25% Discount";
		// calculate discount to insert
		$disPer = "0.25";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "80% Payment"){
		$percentage = "0.8";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "20% Discount";
		// calculate discount to insert
		$disPer = "0.2";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "85% Payment"){
		$percentage = "0.85";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "15% Discount";
		// calculate discount to insert
		$disPer = "0.15";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "90% Payment"){
		$percentage = "0.9";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "10% Discount";
		// calculate discount to insert
		$disPer = "0.1";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} else if ($_POST['discount'] == "95% Payment"){
		$percentage = "0.95";
		$amountToPay = $amount_to_pay * $percentage;
		$discountOff = "5% Discount";
		// calculate discount to insert
		$disPer = "0.05";
		$discountToInsert = $amount_to_pay * $disPer;
		$sql8 = "INSERT INTO `transactions` (`patient_name`,`total_amount`, `total_amount2`, `discount`, `discountOff`, `amount_tendered`, `payment_status`, `payment_date`, `paid_for`, `others`, `hospital_no`, `received_by`,`receipt_no1`) VALUES ('$received', '$amountToPay', '$amount_to_pay', '$discountOff', '$discountToInsert', '$amount_collected', '$payment', '$payment_date', '$being_pay_for', '$others', '$hosp_no', '$firstname','$tran_id1')";
		$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
		$max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
		$max2 = mysqli_query($dbconnect, $max4);
		$result1 = mysqli_fetch_array($max2);
		$result2 = $result1['MAX_RECEIPT_NO2']; 
		$result3 = $result2+1 ;
		$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `payment_date`='" . $payment_date . "'";
		$result4 = mysqli_query($dbconnect, $sql);
		$_SESSION['result3'] = $result3;	
		
		?><script type="text/javascript">
		alert ('Are you sure you want to continue?');
		</script><?php
		?><!doctype html>
		 <html>
		 <head>
		 <meta charset="utf-8">
		 <meta http-equiv="refresh" content="2;url=http://localhost/buth_net/accountSection/genPayrec.php/" />
		 <title>Redirecting....</title>
		 </head>
		 <style>
			#continue_refresh p {
			-moz-box-shadow: 0px 10px 14px -7px #276873;
			-webkit-box-shadow: 0px 10px 14px -7px #276873;
			box-shadow: 0px 10px 14px -7px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
			background-color:#599bb3;
			-moz-border-radius:8px;
			-webkit-border-radius:8px;
			border-radius:4px;
			display:inline-block;
			color:#ffffff;
			font-family:New Times Roman;
			font-size:28px;
			font-weight:bold;
			padding:5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
			margin-top: 200px
			}
		 </style>
		 <body>
		 <div id="continue_refresh">
		 <center><p>Please wait... Your receipt will be ready in 2 seconds...</p></center>
		 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
		 </div>
		 </body>
		 </html><?php
		 exit();

	  
	} 
} else 
	?><script type="text/javascript">
	  alert ('Please fill in at least one field');
	  window.location = "general_payment.php";
	  </script><?php 

		  
?>