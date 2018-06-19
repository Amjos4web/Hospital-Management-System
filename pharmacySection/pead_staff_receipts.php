<?php 
session_start();
ob_start();
// error display configuration
error_reporting(E_ALL & ~E_NOTICE);

if(!isset($_SESSION['emaill'])){
	header('location: pead_pharm_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `pead_pharm` WHERE `pead_name`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$name=$row["pead_name"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// list for payer
$sql8="SELECT * FROM `transactions`";
$check8 = mysqli_query($dbconnect, $sql8);
$resultCount8=mysqli_num_rows($check8); //count the out amount 
if($resultCount8>0){
	while($row=mysqli_fetch_array($check8)){
	$id=$row["id"];
	$sem_name=$row["patient_name"];
	$sem_id=$row["hospital_no"];
	$voucher_paid_for=$row["paid_for"];
	$total=$row["total_amount"];
	}
}
// list for receipt

$cartOutput = "";
$cartTotal = "";

	if(!isset($_SESSION['CartArray4']) || count($_SESSION['CartArray4']) < 1){
		$cartOutput = "<p style='color: red; text-align: center; font-weight: bold; font-size: 20px'>Your Billing Cart is empty</p>";
		} else {
			foreach ($_SESSION['CartArray4'] as $each_item){
				$item_id = $each_item['item_id'];
				$sql2 = "SELECT * FROM `pead_pharm_req` WHERE `id`='$item_id' LIMIT 1";
				$check2 = mysqli_query($dbconnect, $sql2);
				while ($row2=mysqli_fetch_array($check2)){
					$product_name = $row2['product_name'];
					$product_price = $row2['unit_price'];
					$product_details = $row2['category'];
					$quantity_available = $row2['quantity'];
					
					
					$priceTotal = $product_price * $each_item['quantity'];
					$cartTotal = $priceTotal + $cartTotal;
					$percentage = "0.3";
					// dynamic table row assembly
	
					$cartOutput .= "<tr>";
					$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; text-align: center; border: 1px dashed #000000'>" . $product_name . "</td>";
					$cartOutput .= "<td style='font-family: New Times Roman; font-size: 13px; text-align: center; border: 1px dashed #000000'>N" . $priceTotal . "</td>";
					
					$cartOutput .= "</tr>";
				
					$cartTotal = $cartTotal * $percentage;
					
					$sql4 = "SELECT * FROM `pead_pharm_req` WHERE `id`='$item_id' LIMIT 1";
					$check4 = mysqli_query($dbconnect, $sql4);
					while ($row2=mysqli_fetch_array($check4)){
						$quantity = $row2['quantity'];
					}
					$queryLan = "SELECT * FROM `pead_pharm_req` WHERE `id`='$item_id' & `quantity`='$quantity'";
					$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
					$defaultQuanitity = $each_item['quantity'];
					$newQuantity = $quantity - $each_item['quantity'];
					$upDate = "UPDATE `pead_pharm_req` SET `quantity`='$newQuantity' WHERE `id`='$item_id'"; 
					$Check2 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
					
					$queryLan2 = "SELECT * FROM `pead_pharm_req` WHERE `id`='$item_id' & `quantity`='$quantity'";
					$Check = mysqli_query($dbconnect, $queryLan2) or die (mysqli_error($dbconnect));
					$emptyQuantity = "0";
					if ($newQuantity < $emptyQuantity){
						$null = "-";
						$upDate = "UPDATE `pead_pharm_req` SET `quantity`='$null' WHERE `id`='$item_id'";
						$Check3 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
						$upDate5 = "DELETE FROM `pead_pharm_req` WHERE `quantity`='$null' && `id`='$item_id'";
						$Check5 = mysqli_query($dbconnect, $upDate5) or die (mysqli_error($dbconnect));
					}
				}
			}
		}
 
 
  unset($_SESSION['CartArray4']);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Receipt</title>
</head>
<body>
<div id="receipt_wrapper" style="width: 272px; height: 756px; margin-left: auto; margin-right: auto">
  <center><label style="font-family: arial black; font-size: 13px">Bowen University Teaching Hospital</label></center>
  <p style="text-align: center; font-family: Calibri (Body); font-weight: bold; font-size: 14px">Staff Drug Charge Slip</p>
  <label style="font-family: Calibri (Body); font-weight: bold; font-size: 13px"><?php echo "Payer ID:" . " " .$sem_name; ?></label>
  <label style="float: right; font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo "Hosp. No:" . " " .$sem_id; ?></label>
  <p style="font-family: Calibri (Body); font-weight: bold; font-size: 13px"><?php echo date("l jS \of F Y"). "," . " " . date('H:i:s'); ?></p>
  <label style="float: left; font-family: Calibri (Body); font-weight: bold; font-size: 14px"><?php echo "Being Payment For:" . " " .$voucher_paid_for; ?></label><br>
	 <table width="272px"  style="margin-left: auto; margin-right: auto; min-height: 150px" cellspacing="0" border="0" >
	   <tr>
		<td width="50%" style='font-family: arial; text-align: center; font-size: 13px; font-weight: bold; border: 1px dashed #000000'>Drugs</b></td>
		<td width="50%" style='font-family: arial; text-align: center; font-size: 13px; font-weight: bold; border: 1px dashed #000000'>Total</b></td>
		</tr>
		<?php echo $cartOutput; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
	  </table>
	  <?php echo '<h2 style="font-family: arial black;text-align: center; font-weight: bold; font-size: 15px">Total: N'.$total.'</h2>' ?>
	  <?php echo '<h2 style="font-family: arial black;text-align: center; font-weight: bold; font-size: 15px">30% Off: N'.$cartTotal.'</h2>' ?>
	  <center><label style="font-family: arial"><?php echo $name; ?></label></center>
	  <center><label style='font-family: Bradley Hand ITC; font-size: 24px'>signed</label><center>
	 <p style="text-align: center; font-family: Calibri (Body); font-weight: normal; font-size: 14px">Powered By Buth ICT</p>
	 </div>
	  
</body>
</html>