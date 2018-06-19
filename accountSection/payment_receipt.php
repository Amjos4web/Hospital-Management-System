<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['emaill'])){
	header('location: cashier_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `cashier` WHERE `username_id`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$password=$row["password"];
	$first_name=$row["first_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}



$amount_tendered = trim($_POST['amount_tendered']);
$payment = "paid";
$tran_id1 = date('ym') . "000";
$payment_date = date('Y-m-d H:i:s');
include_once "search_angle.php";
$search = $_SESSION['search2'];
$sql8="SELECT * FROM `transactions` WHERE `hospital_no`='$search' LIMIT 1";
$check8 = mysqli_query($dbconnect, $sql8);
$resultCount8=mysqli_num_rows($check8); //count the out amount 
if($resultCount8>0){
	while($row=mysqli_fetch_array($check8)){
	$patient_name=$row["patient_name"];
	$hospital_No=$row["hospital_no"];
	}
}

if (empty($amount_tendered) == false)
{
	
	$sql8 = "UPDATE `transactions` SET `payment_status`='$payment',`payment_date`='$payment_date', `amount_tendered`='$amount_tendered', `received_by`='$first_name',`receipt_no1`='$tran_id1'  WHERE `hospital_no`='$search'";
	$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
    $max4 = "SELECT MAX(receipt_no1) AS MAX_RECEIPT_NO2 FROM `transactions`";
	$max2 = mysqli_query($dbconnect, $max4);
	$result1 = mysqli_fetch_array($max2);
	$result2 = $result1['MAX_RECEIPT_NO2']; 
	$result3 = $result2+1 ;
	$sql = "UPDATE `transactions` SET `receipt_no1`='$result3' WHERE `hospital_no`='" . $search . "'";
	$result4 = mysqli_query($dbconnect, $sql);
	 
	 ?><!doctype html>
	 <html>
	 <head>
	 <meta charset="utf-8">
	 <meta http-equiv="refresh" content="5;url=http://localhost/buth_net/accountSection/payment_receipts.php/" />
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
	 <center><p>Please wait... Your receipt will be ready in 5 seconds...</p></center>
	 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
	 </div>
	 </body>
	 </html><?php
	 exit();
    } else {
		?><script type="text/javascript">
	      alert ('Please enter the amount tendered by the customer');
		  window.location = "account.php";
		  </script><?php 
	}
	
?>

