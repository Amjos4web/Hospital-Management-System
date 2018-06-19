<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');

if(!isset($_SESSION['email'])){
	header('location: clients_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['email'];
include "dbconnect2.php";
$sql="SELECT * FROM `client_staff` WHERE `username`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["client_id"];
	$password=$row["password"];
	$name=$row["name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}
?>
<?php
//list for receipt

$cartOutput = "";
$cartTotal = "";
$per = "";
	if(!isset($_SESSION['CartArray']) || count($_SESSION['CartArray']) < 1){
		$cartOutput = "<p style='color: red; text-align: center; font-weight: bold; font-size: 20px'>Your Billing Cart is empty</p>";
	} else {
		foreach ($_SESSION['CartArray'] as $each_item){
			$item_id = $each_item['item_id'];
			$sql2 = "SELECT * FROM `products` WHERE `product_id`='$item_id' LIMIT 1";
			$check2 = mysqli_query($dbconnect, $sql2);
			while ($row2=mysqli_fetch_array($check2)){
				$product_name = $row2['product_name'];
				$product_price = $row2['price'];
				$product_details = $row2['details'];
				
				
				$priceTotal = $product_price * $each_item['quantity'];
				$cartTotal = $priceTotal + $cartTotal;
				$percentage = "0.1";
				// dynamic table row assembly
				$cartOutput .= "<tr>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>" . $product_name . "</td>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>N" . $product_price . "</td>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>" . $each_item['quantity'] . "</td>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>N" . $priceTotal . "</td>";
				
				$cartOutput .= "</tr>";
				$cartTotal = $cartTotal;
				$per = $cartTotal * $percentage;
				
			}
		}
	}
?>
<?php					
$nhis_name = $_POST['nhis_name'];
$nhis_name = preg_replace("#[^a-z.]#i", "",$_POST['nhis_name']);
$nhis_id = $_POST['nhis_id'];
$payment_date = date('Y-m-d');
$voucher_paid_for = "Drugs";


if (empty($nhis_name && $nhis_id) == false)
{
	$sql7 = "SELECT * FROM `transactions` WHERE `hospital_no`='$nhis_id'";
	$query7 = mysqli_query($dbconnect, $sql7) or die (mysqli_error($dbconnect));
	$check8 = mysqli_num_rows($query7);
	
	$sql8 = "INSERT INTO `transactions` (`patient_name`,`hospital_no`,`total_amount`,`total_amount2`,`payment_date`,`staff_id`, `paid_for`) VALUES ('$nhis_name', '$nhis_id', '$cartTotal', '$per', '$payment_date', '$name', '$voucher_paid_for')";
	$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
	
	?><script type="text/javascript">
	alert ('Are you sure you want to continue?');
	</script><?php
	?><!doctype html>
	 <html>
	 <head>
	 <meta charset="utf-8">
	 <meta http-equiv="refresh" content="5;url=http://localhost/buth_net/pharmacySection/nhis_receipts.php/" />
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
	 <center><img src="images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
	 </div>
	 </body>
	 </html><?php
	 exit();
} else 
	// header ('location: cart.php');
	?><script type="text/javascript">
	  alert ('Please enter the name and ID');
	  window.location = "cart.php";
	  </script><?php 

?>

