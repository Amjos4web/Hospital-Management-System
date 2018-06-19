<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: admin_login.php');
}
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$admin_password=$row["admin_password"];
	$name=$row["name"];
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
	
	$total_unit_cost = array();
	$total_unit_price = array();
	$display = "SELECT * FROM `products` WHERE `date_added` >= '$from_date' AND `date_added` <= '$to_date'";
	$displayCheck = mysqli_query($dbconnect, $display) or die (mysqli_error($dbconnect));
	$displayResult = mysqli_num_rows($displayCheck);
	if ($displayResult > 0){
		while($row=mysqli_fetch_assoc($displayCheck)){
			$date_added = $row['date_added'];
			$drug_name = $row['product_name'];
			$quantity = $row['quantity_available'];
			$selling_price2 = $row['price'];
			$cost_price2 = $row['cost_price'];
			$total_unit_cost[] = $quantity * $cost_price2;
			$total_unit_price[] = $quantity * $selling_price2;
			
			
			
			
			
			foreach ($total_unit_price as $total1){
				if (!empty($total1)){
					$price_total = $total1;
					$_SESSION['total1'] = $total1;
				}
				
			}
			foreach ($total_unit_cost as $total2){
				if (!empty($total2)){
					$cost_total = $total2;
					$_SESSION['total2'] = $total2;
				}
				
			}
			// display the specified drugs information
			$dynamic_list .= "<tr>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$date_added . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$drug_name. "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$quantity . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$selling_price2 . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$cost_price2 . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$total2 . "</td>";
			$dynamic_list .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$total1 . "</td>";
			$dynamic_list .= "</tr>";
			
			// sum for quantity_available
			$quant = $_SESSION['quant'];
			
			// sum for grand_cost_price
			$grand_cost_price = array_sum($total_unit_cost);
			
			// sum for grand_selling price
			$grand_selling_price = array_sum($total_unit_price);
			
			// get expected profit
			$expt_profit = $grand_selling_price - $grand_cost_price;
			
			
		}
		$dynamic_lists .= "<tr>";
		$dynamic_lists .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$quant. "</td>";
		$dynamic_lists .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>" .$grand_cost_price. "</td>";
		$dynamic_lists .= "<td style='text-align: center; font-family: Adobe Heiti Std R; border: 1px dashed #000000; font-size: 9px;'>".$grand_selling_price. "</td>";
		$dynamic_lists .= "</tr>";
	}
}
   

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Stock Summary/Receipt</title>
</head>
<body>
<div id="requisition_receipt" style="width: 800px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 20px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <p style="text-align: center; font-size: 16px; font-family: arial">Stock Valuation Summary From: <?php echo $from_date. " "; ?>To:<?php echo " " . $to_date; ?></p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 9px; margin-left: 20px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="0">
   <tr>
	    <td width="13%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000; font-size: 9px;'><b>Date Added</b></td>
		<td width="22%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000; font-size: 9px;'><b>Drug Name</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000; font-size: 9px;'><b>Total Qty Avail.</b></td>
		<td width="10%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000; font-size: 9px;'><b>Unit/Selling Price N</b></td>
		<td width="10%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000; font-size: 9px;'><b>Cost Price N</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000; font-size: 9px;'><b>Total Cost Price N</b></td>
		<td width="15%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000; font-size: 9px;'><b>Expd. Selling Price N</b></td>
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
	    <td width="34%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Grand Quantity</b></td>
		<td width="33%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Grand Cost Price N</b></td>
		<td width="33%" style='font-family: arial black; text-align: center; font-size: 9px; border: 1px dashed #000000'><b>Grand Selling Price N</b></td>
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
		<p style="text-align: center; font-family: monospace; font-weight: normal; font-size: 12px"><?php echo "Expected Profit/Loss" . " " ."=" ." ". "N" . $expt_profit; ?></p>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
