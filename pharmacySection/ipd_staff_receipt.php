<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: ipd_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `ipd_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'You have no Information yet in the Database</p>";
}
?>
<?php
//list for receipt

$cartOutput = "";
$cartTotal = "";
$per = "";
	if(!isset($_SESSION['CartArray5']) || count($_SESSION['CartArray5']) < 1){
		$cartOutput = "<p style='color: red; text-align: center; font-weight: bold; font-size: 20px'>Your Billing Cart is empty</p>";
	} else {
		foreach ($_SESSION['CartArray5'] as $each_item){
			$item_id = $each_item['item_id'];
			$sql2 = "SELECT * FROM `ipd_pharm_req` WHERE `id`='$item_id' LIMIT 1";
			$check2 = mysqli_query($dbconnect, $sql2);
			while ($row2=mysqli_fetch_array($check2)){
				$product_name = $row2['product_name'];
				$product_price = $row2['unit_price'];
				$category = $row2['category'];
				
				
				$priceTotal = $product_price * $each_item['quantity'];
				$cartTotal = $priceTotal + $cartTotal;
				$percentage = "0.3";
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
$staff_name = $_POST['staff_name'];
$staff_name = preg_replace("#[^a-z.]#i", "",$_POST['staff_name']);
$staff_id = $_POST['staff_id'];
$payment_date = date('Y-m-d');
$voucher_paid_for = "Drugs";


if (empty($staff_name && $staff_id) == false)
{
	$sql7 = "SELECT * FROM `transactions` WHERE `hospital_no`='$staff_id'";
	$query7 = mysqli_query($dbconnect, $sql7) or die (mysqli_error($dbconnect));
	$check8 = mysqli_num_rows($query7);
	
	$sql8 = "INSERT INTO `transactions` (`patient_name`,`hospital_no`,`total_amount`,`total_amount2`,`payment_date`,`staff_id`, `paid_for`) VALUES ('$staff_name', '$staff_id', '$cartTotal', '$per', '$payment_date', '$name', '$voucher_paid_for')";
	$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
	
	?><script type="text/javascript">
	alert ('Are you sure you want to continue?');
	</script><?php
	?><!doctype html>
	 <html>
	 <head>
	 <meta charset="utf-8">
	 <meta http-equiv="refresh" content="5;url=http://localhost/buth_net/pharmacySection/ipd_staff_receipts.php/" />
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
} else 
	// header ('location: cart.php');
	?><script type="text/javascript">
	  alert ('Please enter the staff name and ID');
	  window.location = "ipd_cart.php";
	  </script><?php 

?>

