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
// check if the product id is set
if (isset($_POST['product_id'])){
	$product_id = $_POST['product_id'];
	$wasFound = false;
	$i = 0;
	// if the cert session is not set or cart array is empty
    if (!isset($_SESSION['CartArray2']) || count($_SESSION['CartArray2']) < 1){
		// run script if the cart is empty or not set
		$_SESSION['CartArray2'] = array(0 => array('item_id' => $product_id, 'quantity' => 1));
	} else {
		// run the script if the cart has at least one in it
		foreach ($_SESSION['CartArray2'] as $each_item){
			$i++;
			while (list($key, $value) = each($each_item)){
				if ($key == 'item_id' && $value == $product_id){
					// That item is in cart already, so let's adjust the quantity using array_splice()
					array_splice($_SESSION['CartArray2'],$i-1,1, array(array('item_id' => $product_id, 'quantity' => $each_item['quantity'] + 1)));
					$wasFound = true;
				} // close the if condition
			} // close the while loop
		} // close the for each loop
	if ($wasFound == false){
		array_push($_SESSION['CartArray2'], array('item_id' => $product_id, 'quantity' => 1));
	}
  }
  header("location: requisition.php");
  exit();
}
?>
<?php
// if the user chooses to empty the cart
if (isset($_GET['cmd']) && $_GET['cmd'] == 'emptycart'){
	unset($_SESSION['CartArray2']);
}
?>

<?php
// if the user chooses adjust quantity
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != ""){
	// run some code
	$item_to_adjust = $_POST['item_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace("#[^0-9]#i", "",$quantity); // filter everything but numbers
	if($quantity < 1){$quantity = 1;}
	$i = 0;
	foreach ($_SESSION['CartArray2'] as $each_item){
		$i++;
		while (list($key, $value) = each($each_item)){
			if ($key == 'item_id' && $value == $item_to_adjust){
				// That item is in cart already, so let's adjust the quantity using array_splice()
				array_splice($_SESSION['CartArray2'],$i-1,1, array(array('item_id' => $item_to_adjust, 'quantity' => $quantity)));
			} // close the if condition
		} // close the while loop
	} // close the for each loop
}       
?>


<?php
// if the user want to remove an item from the list
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != ""){
	// if the user want to remove item form cart
	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION['CartArray2']) <= 1){
		unset($_SESSION['CartArray2']);
	} else {
		unset($_SESSION['CartArray2'][$key_to_remove]);
		sort($_SESSION['CartArray2']);
	}
	
}
?>
<?php
// render the cart for user to viewing
$cartOutput = "";
$cartTotal = "";
$success = "";
$success2 = "";
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
			

		
			// dynamic table row assembly
			
			$cartOutput .= "<tr>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $item_id . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $product_name . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $category . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $drug_type . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $quantity_available . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>N" . $product_price . "</td>";
			$cartOutput .= '<td style="background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px"><form action="requisition.php" method="post"><input type="text" name="quantity" value="'.$each_item['quantity'].'" size="1" maxlength="2"><input type="submit" name="adjustBtn' . $item_id . '" value="Change" id="adjustBtn"><input name="item_to_adjust" type="hidden" value= "'.$item_id.'"></form></td>';
			$cartOutput .= '<td style="background-color:#CECECE"><form action="requisition.php" method="post"><input type="submit" name="deleteBtn' . $item_id . '" value="X" id="deleteBtn"><input name="index_to_remove" type="hidden" value= "'.$i.'"></form></td>';
			$cartOutput .= "</tr>";
			$i++;
		
            $cartTotal = $cartTotal;
			
			if (isset($_POST['forward'])){
				$date_added = date('Y-m-d');
				$quantity = $each_item['quantity'];
				if (count($_SESSION['CartArray2']) > 0){
					$sqll = "SELECT * FROM `ae_pharm_req` WHERE `id`='$item_id'";
					$sql8 = "INSERT INTO `ae_pharm_req` (`product_name`,`category`,`unit_price`,`quantity`,`staff_name`,`drug_type`, `payment_date`) VALUES ('$product_name', '$category', '$product_price', '$quantity', '$name', '$drug_type', '$date_added')";
					$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
					if ($query8){
						$success = "Your requisition has been successfully moved to A and E pharmacy";
					}
					header ("refresh:3; url=ae_requisition_receipt.php"); // wait for 3 secs before redirect
					$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
					$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
					$defaultQuanitity = $each_item['quantity'];
					$newQuantity = $quantity_available - $each_item['quantity'];
					$upDate = "UPDATE `products` SET `quantity_available`='$newQuantity' WHERE `product_id`='$item_id'"; 
					$Check2 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
					
					$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
					$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
					$emptyQuantity = "0";
					if ($newQuantity = $emptyQuantity){
						$null = "-";
						$upDate = "UPDATE `products` SET `quantity_available`='$null' WHERE `product_id`='$item_id'";
						$Check3 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
						$upDate5 = "DELETE FROM `products` WHERE `quantity_available`='$null' && `product_id`='$item_id'";
						$Check5 = mysqli_query($dbconnect, $upDate5) or die (mysqli_error($dbconnect));
					}
				} else {
					$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Requisition Is Still Empty</p>";
				}
				
			}
				
				if (isset($_POST['forward2'])){
					$date_added = date('Y-m-d');
					$quantity = $each_item['quantity'];
					if (count($_SESSION['CartArray2']) > 0){
						$sqll = "SELECT * FROM `ae_pharm_req` WHERE `id`='$item_id'";
						$sql8 = "INSERT INTO `pead_pharm_req` (`product_name`,`category`,`unit_price`,`quantity`,`staff_name`, `drug_type`, `date_added`) VALUES ('$product_name', '$category', '$product_price', '$quantity', '$name', '$drug_type', '$date_added')";
						$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
						if ($query8){
							$success = "Your requisition has been successfully moved to Peadetrics and Maternity pharmacy";
						}
						header ("refresh:3; url=pead_requisition_receipt.php"); // wait for 3 secs before redirect
						$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
						$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
						$defaultQuanitity = $each_item['quantity'];
						$newQuantity = $quantity_available - $each_item['quantity'];
						$upDate = "UPDATE `products` SET `quantity_available`='$newQuantity' WHERE `product_id`='$item_id'"; 
						$Check2 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
		
						$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
						$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
						$emptyQuantity = "0";
						if ($newQuantity = $emptyQuantity){
							$null = "-";
							$upDate = "UPDATE `products` SET `quantity_available`='$null' WHERE `product_id`='$item_id'";
							$Check3 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
							$upDate5 = "DELETE FROM `products` WHERE `quantity_available`='$null' && `product_id`='$item_id'";
							$Check5 = mysqli_query($dbconnect, $upDate5) or die (mysqli_error($dbconnect));
						}
					} else {
					$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Requisition Is Still Empty</p>";
					}
				}
				if (isset($_POST['forward3'])){
					$date_added = date('Y-m-d');
					$quantity = $each_item['quantity'];
					if (count($_SESSION['CartArray2']) > 0){
						$sqll = "SELECT * FROM `ipd_pharm_req` WHERE `id`='$item_id'";
						$sql8 = "INSERT INTO `ipd_pharm_req` (`product_name`,`category`,`unit_price`,`quantity`,`staff_name`,`drug_type`, `date_added`) VALUES ('$product_name', '$category', '$product_price', '$quantity', '$name', '$drug_type', '$date_added')";
						$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
						if ($query8){
							$success = "Your requisition has been successfully moved to IPD pharmacy Section";
						}
						header ("refresh:3; url=ipd_requisition_receipt.php"); // wait for 3 secs before redirect
						$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
						$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
						$defaultQuanitity = $each_item['quantity'];
						$newQuantity = $quantity_available - $each_item['quantity'];
						$upDate = "UPDATE `products` SET `quantity_available`='$newQuantity' WHERE `product_id`='$item_id'"; 
						$Check2 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
						
						$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
						$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
						$emptyQuantity = "0";
						if ($newQuantity = $emptyQuantity){
							$null = "-";
							$upDate = "UPDATE `products` SET `quantity_available`='$null' WHERE `product_id`='$item_id'";
							$Check3 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
							$upDate5 = "DELETE FROM `products` WHERE `quantity_available`='$null' && `product_id`='$item_id'";
							$Check5 = mysqli_query($dbconnect, $upDate5) or die (mysqli_error($dbconnect));
						}
					} else {
					$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Requisition Is Still Empty</p>";
					}
			    }
				
				if (isset($_POST['forward4'])){
					$date_added = date('Y-m-d');
					$quantity = $each_item['quantity'];
					if (count($_SESSION['CartArray2']) > 0){	
						$sqll = "SELECT * FROM `mopd_pharm_req` WHERE `id`='$item_id'";
						$sql8 = "INSERT INTO `mopd_pharm_req` (`product_name`,`category`,`unit_price`,`quantity`,`staff_name`,`drug_type`, `date_added`) VALUES ('$product_name', '$category', '$product_price', '$quantity', '$name', '$drug_type', '$date_added')";
						$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
						if ($query8){
							$success = "Your requisition has been successfully moved to MOPD pharmacy Section";
						}
						header ("refresh:3; url=mopd_requisition_receipt.php"); // wait for 3 secs before redirect
						$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
						$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
						$defaultQuanitity = $each_item['quantity'];
						$newQuantity = $quantity_available - $each_item['quantity'];
						$upDate = "UPDATE `products` SET `quantity_available`='$newQuantity' WHERE `product_id`='$item_id'"; 
						$Check2 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
						
						$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
						$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
						$emptyQuantity = "0";
						if ($newQuantity = $emptyQuantity){
							$null = "-";
							$upDate = "UPDATE `products` SET `quantity_available`='$null' WHERE `product_id`='$item_id'";
							$Check3 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
							$upDate5 = "DELETE FROM `products` WHERE `quantity_available`='$null' && `product_id`='$item_id'";
							$Check5 = mysqli_query($dbconnect, $upDate5) or die (mysqli_error($dbconnect));
						}
					} else {
					$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Requisition Is Still Empty</p>";
					}
			    }
				
				if (isset($_POST['forward5'])){
					$date_added = date('Y-m-d');
					$quantity = $each_item['quantity'];
					if (count($_SESSION['CartArray2']) > 0){
					$sqll = "SELECT * FROM `copd_pharm_req` WHERE `id`='$item_id'";
					$sql8 = "INSERT INTO `copd_pharm_req` (`product_name`,`category`,`unit_price`,`quantity`,`staff_name`,`drug_type`, `date_added`) VALUES ('$product_name', '$category', '$product_price', '$quantity', '$name', '$drug_type', '$date_added')";
					$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
					if ($query8){
						$success = "Your requisition has been successfully moved to COPD pharmacy Section";
					}
					header ("refresh:3; url=copd_requisition_receipt.php"); // wait for 3 secs before redirect
					$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
					$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
					$defaultQuanitity = $each_item['quantity'];
					$newQuantity = $quantity_available - $each_item['quantity'];
					$upDate = "UPDATE `products` SET `quantity_available`='$newQuantity' WHERE `product_id`='$item_id'"; 
					$Check2 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
					
					$queryLan = "SELECT * FROM `products` WHERE `product_id`='$item_id' & `quantity_available`='$quantity_available'";
					$Check = mysqli_query($dbconnect, $queryLan) or die (mysqli_error($dbconnect));
					$emptyQuantity = "0";
					if ($newQuantity = $emptyQuantity){
						$null = "-";
						$upDate = "UPDATE `products` SET `quantity_available`='$null' WHERE `product_id`='$item_id'";
						$Check3 = mysqli_query($dbconnect, $upDate) or die (mysqli_error($dbconnect));
						$upDate5 = "DELETE FROM `products` WHERE `quantity_available`='$null' && `product_id`='$item_id'";
						$Check5 = mysqli_query($dbconnect, $upDate5) or die (mysqli_error($dbconnect));
				    }
				} else {
				$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Requisition Is Still Empty</p>";
				}
			    }
			}
		}
	}	

// unset($_SESSION['CartArray2']);
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css" media="screen">
<link href='https://fonts.googleapis.com/css?family=Fjalla+One|Arimo|Merriweather|Ubuntu' rel='stylesheet' type='text/css'>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Requisition Page</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('.closebtn').click(function(){
		$('.isa_success').fadeOut(1000);
	})
	$('.submit8').click(function(){
		$('.submit7').fadeIn(2000);
		$('.submit8').fadeOut(1000);
	})
})
</script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	  <?php include_once "pharmacy_nav.php"; ?>
    </ul>
	<?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
	<div class="product_details">										
	 <hr style='width: 800px; margin-left: 0px; height: 6px; background-color: #14BCEB'><br>
	 <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15); font-style: normal'>Requisition Section</h2>
	   <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="6" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>ID</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Name</b></td>
		<td width="22%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Category</b></td>
		<td width="8%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Type</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Qty Avail.</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Selling Price</b></td>
		<td width="9%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Quantity</b></td>
		<td width="9%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Remove</b></td>
		</tr>
		<?php echo $cartOutput; ?>
		<?php echo $msg; ?>
		<?php
		if ((isset($_POST['forward']) && count($_SESSION['CartArray2']) > 0)){
			?><center><?php echo "<div class='isa_success'><span class='successbtn'>&#x2705;</span><span class='closebtn' onclick='this.parentElement.style.display='none'>&times;</span>" .$success; ?></div></center><br><br><?php
		}
		if ((isset($_POST['forward2']) && count($_SESSION['CartArray2']) > 0)){
			?><center><?php echo "<div class='isa_success'><span class='successbtn'>&#x2705;</span><span class='closebtn' onclick='this.parentElement.style.display='none'>&times;</span>".$success; ?></div></center><br><br><?php
		}
		if ((isset($_POST['forward3']) && count($_SESSION['CartArray2']) > 0)){
			?><center><?php echo "<div class='isa_success'><span class='successbtn'>&#x2705;</span><span class='closebtn' onclick='this.parentElement.style.display='none'>&times;</span>".$success; ?></div></center><br><br><?php
		}
		if ((isset($_POST['forward4']) && count($_SESSION['CartArray2']) > 0)){
			?><center><?php echo "<div class='isa_success'><span class='successbtn'>&#x2705;</span><span class='closebtn' onclick='this.parentElement.style.display='none'>&times;</span>".$success; ?></div></center><br><br><?php
		}
		if ((isset($_POST['forward5']) && count($_SESSION['CartArray2']) > 0)){
			?><center><?php echo "<div class='isa_success'><span class='successbtn'>&#x2705;</span><span class='closebtn' onclick='this.parentElement.style.display='none'>&times;</span>".$success; ?></div></center><br><br><?php
		}
		?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		</tr-->
		</table>
	   </div><br>
	    <input type="submit"  class="submit8" name="forward" value="Click Here To Forward">
		<label class="add_more_drugs" style="float: right"><a href='pharmacy_store_requisition_add.php'>Add More Drugs</a></label>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <input type="submit"  class="submit7" name="forward" value="A and E Pharmacy">
	   </form>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <input type="submit" class="submit7" name="forward2" value="MCH Pharmacy">
	   </form>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <input type="submit" class="submit7" name="forward3" value="IPD Pharmacy">
	   </form>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <input type="submit" class="submit7" name="forward4" value="MOPD Pharmacy">
	   </form>
	   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <input type="submit" class="submit7" name="forward5" value="COPD Pharmacy">
	   </form><br>
	   <h2 class="empty"><a href='requisition.php?cmd=emptycart'>Click here to empty requisition</a></h2>
          <hr style='width: 800px; margin-left: 0px; height: 6px; background-color: #14BCEB'><br>
	<!-- end .margin --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
