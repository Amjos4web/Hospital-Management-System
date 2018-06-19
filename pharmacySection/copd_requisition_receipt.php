<?php 
session_start();
ob_start();
// error display configuration
if(!isset($_SESSION['emaill'])){
	header('location: pharmacy_store.php');
}
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
$cartOutput = "";
if(!isset($_SESSION['CartArray2']) || count($_SESSION['CartArray2']) < 1){
	$cartOutput = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Requisition Is Empty</p>";
} else {
	$i = 0;
	foreach ($_SESSION['CartArray2'] as $each_item){
		$item_id = $each_item['item_id'];
		$sql2 = "SELECT * FROM `products` WHERE `product_id`='$item_id' LIMIT 3";
		$check2 = mysqli_query($dbconnect, $sql2);
		while ($row2=mysqli_fetch_array($check2)){
			$product_name = $row2['product_name'];
			$product_price = $row2['price'];
			$category=$row2["category"];
			$quantity_available = $row2['quantity_available'];
			$drug_type=$row2["drug_type"];
			$quantity = $each_item['quantity'];

		
			// dynamic table row assembly
			
			$cartOutput .= "<tr>";
			$cartOutput .= "<td style='font-family: Adobe Heiti Std R; font-size: 14px; border: 1px dashed #000000'>" . $item_id . "</td>";
			$cartOutput .= "<td style='font-family: Adobe Heiti Std R; font-size: 14px; border: 1px dashed #000000'>" . $product_name . "</td>";
			$cartOutput .= "<td style='font-family: Adobe Heiti Std R; font-size: 14px; border: 1px dashed #000000'>" . $category . "</td>";
			$cartOutput .= "<td style='font-family: Adobe Heiti Std R; font-size: 14px; border: 1px dashed #000000'>" . $drug_type . "</td>";
			$cartOutput .= "<td style='font-family: Adobe Heiti Std R; font-size: 14px; border: 1px dashed #000000'>" . $quantity . "</td>";
			$cartOutput .= "<td style='font-family: Adobe Heiti Std R; font-size: 14px; border: 1px dashed #000000'>N" . $product_price . "</td>";
			$cartOutput .= "</tr>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Receipt</title>
</head>
<body>
<div id="requisition_receipt" style="width: 600px; min-height: 300px; margin-left: auto; margin-right: auto">
 <h1 style="text-align: center; font-size: 20px; font-family: monospace">Bowen University Teaching Hospital, Ogbomoso</h1>
 <p style="text-align: center; font-size: 16px; font-family: arial">Requisition Forwarded To COPD Pharmacy Section</p>
 <p style="font-family: Calibri (Body); font-weight: bold; font-size: 14px; float: left"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <table width="600px" style="margin-left: auto; margin-right: auto" cellpadding="6" cellspacing="0" border="1">
   <tr>
	<td width="5%"><b>ID</b></td>
	<td width="28%"><b>Name</b></td>
	<td width="30%"><b>Category</b></td>
	<td width="10%"><b>Type</b></td>
	<td width="12%"><b>Qty Forwarded.</b></td>
	<td width="15%"><b>Unit Price</b></td>
	</tr>
	<?php echo $cartOutput; ?>
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
	 <center><label style="font-family: arial"><?php echo "Forwarded By". " " .$name; ?></label></center><br>
	 <center><label style="text-align: center; font-family: arial; font-weight: normal">Received By --------------------</label></center>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	</div>
  </body>
 </html>
