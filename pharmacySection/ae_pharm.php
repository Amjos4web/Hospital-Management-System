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
	if(!isset($_SESSION['CartArray2']) || count($_SESSION['CartArray2']) < 1){
		$cartOutput = "<p style='color: red; text-align: center; font-weight: bold; font-size: 20px'>Your requisition is empty</p>";
	} else {
		foreach ($_SESSION['CartArray2'] as $each_item){
			$item_id = $each_item['item_id'];
			$sql2 = "SELECT * FROM `products` WHERE `product_id`='$item_id' LIMIT 1";
			$check2 = mysqli_query($dbconnect, $sql2);
			while ($row2=mysqli_fetch_array($check2)){
				$product_name = $row2['product_name'];
				$product_price = $row2['price'];
				$product_details = $row2['details'];
				$category=$row2["category"];
				$quantity_available = $row2['quantity_available'];
				
				
				$priceTotal = $product_price * $each_item['quantity'];

				// dynamic table row assembly
				$cartOutput .= "<tr>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>" . $product_name . "</td>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>N" . $product_price . "</td>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>" . $each_item['quantity'] . "</td>";
				$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; padding-left: 10px'>N" . $priceTotal . "</td>";
				
				$cartOutput .= "</tr>";
				$quantity = $each_item['quantity'];
				
				$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
				$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
				$defaultQuanitity = $each_item['quantity'];
				$newQuantity = $quantity_available - $each_item['quantity'];
				$upDate = "UPDATE `products` SET `quantity_available`='$newQuantity' WHERE `product_id`='$item_id'"; 
				$Check2 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
				
				
				$date_added = date('Y-m-d');
				$sql8 = "INSERT INTO `ae_pharm_req` (`product_id`,`product_name`,`category`,`unit_price`,`quantity`,`staff_name`, `payment_date`) VALUES ('$item_id', '$product_name', '$category', '$product_price', '$quantity', '$name', '$date_added')";
				$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));

				?><script type="text/javascript">
				alert ('Are you sure you want to continue?');
				</script><?php
				?><!doctype html>
				 <html>
				 <head>
				 <meta charset="utf-8">
				 <meta http-equiv="refresh" content="5;url=http://localhost/buth_net/pharmacySection/requisition.php/" />
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
				 <center><p>Drugs have been successfully moved to A and E pharmacy...  Redirecting in 5 seconds...</p></center>
				 <center><img src="images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
				 </div>
				 </body>
				 </html><?php
				 exit();
								
				}
			}
		}
?>


