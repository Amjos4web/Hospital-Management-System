<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: mopd_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `mopd_login` WHERE `emailAdd`='$email' LIMIT 1";
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
// check if the product id is set
if (isset($_POST['id'])){
	$product_id = $_POST['id'];
	$wasFound = false;
	$i = 0;
	// if the cert session is not set or cart array is empty
    if (!isset($_SESSION['CartArray4']) || count($_SESSION['CartArray4']) < 1){
		// run script if the cart is empty or not set
		$_SESSION['CartArray4'] = array(0 => array('item_id' => $product_id, 'quantity' => 1));
	} else {
		// run the script if the cart has at least one in it
		foreach ($_SESSION['CartArray4'] as $each_item){
			$i++;
			while (list($key, $value) = each($each_item)){
				if ($key == 'item_id' && $value == $product_id){
					// That item is in cart already, so let's adjust the quantity using array_splice()
					array_splice($_SESSION['CartArray4'],$i-1,1, array(array('item_id' => $product_id, 'quantity' => $each_item['quantity'] + 1)));
					$wasFound = true;
				} // close the if condition
			} // close the while loop
		} // close the for each loop
	if ($wasFound == false){
		array_push($_SESSION['CartArray4'], array('item_id' => $product_id, 'quantity' => 1));
	}
  }
  header("location: mopd_cart.php");
  exit();
}
?>
<?php
// if the user chooses to empty the cart
if (isset($_GET['cmd']) && $_GET['cmd'] == 'emptycart'){
	unset($_SESSION['CartArray4']);
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
	 foreach ($_SESSION['CartArray4'] as $each_item){
		$i++;
		while (list($key, $value) = each($each_item)){
			if ($key == 'item_id' && $value == $item_to_adjust){
				// That item is in cart already, so let's adjust the quantity using array_splice()
				array_splice($_SESSION['CartArray4'],$i-1,1, array(array('item_id' => $item_to_adjust, 'quantity' => $quantity)));
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
	if (count($_SESSION['CartArray4']) <= 1){
		unset($_SESSION['CartArray4']);
	} else {
		unset($_SESSION['CartArray4'][$key_to_remove]);
		sort($_SESSION['CartArray4']);
	}
	
}
?>
<?php
// render the cart for user to viewing
$cartOutput = "";
$cartTotal = "";
if(!isset($_SESSION['CartArray4']) || count($_SESSION['CartArray4']) < 1){
	$cartOutput = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Billing Cart Is Empty</p>";
} else {
	$i = 0;
	foreach ($_SESSION['CartArray4'] as $each_item){
		$item_id = $each_item['item_id'];
		$sql2 = "SELECT * FROM `mopd_pharm_req` WHERE `id`='$item_id'";
		$check2 = mysqli_query($dbconnect, $sql2);
		while ($row2=mysqli_fetch_array($check2)){
			$product_name = $row2['product_name'];
			$product_price = $row2['unit_price'];
			$category=$row2["category"];
			$quantity_available=$row2["quantity"];
			$drug_type=$row2["drug_type"];
			
			$priceTotal = $product_price * $each_item['quantity'];
			$cartTotal = $priceTotal + $cartTotal;
			// dynamic table row assembly
			$cartOutput .= "<tr>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $item_id . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $product_name . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $category . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $drug_type . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $quantity_available . "</td>";
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>N" . $product_price . "</td>";
			$cartOutput .= '<td style="background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px"><form action="mopd_cart.php" method="post"><input type="text" name="quantity" value="'.$each_item['quantity'].'" size="1" maxlength="2"><input type="submit" name="adjustBtn' . $item_id . '" value="Change" id="adjustBtn"><input name="item_to_adjust" type="hidden" value= "'.$item_id.'"></form></td>';
			$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>N" . $priceTotal . "</td>";
			$cartOutput .= '<td style="background-color:#CECECE"><form action="mopd_cart.php" method="post"><input type="submit" name="deleteBtn' . $item_id . '" value="X" id="deleteBtn"><input name="index_to_remove" type="hidden" value= "'.$i.'"></form></td>';
			$cartOutput .= "</tr>";
			$i++;
		
            $cartTotal = $cartTotal;
		}
	}
}	

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css" media="screen">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Your Cart</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
 $('#gen').click(function(){
	 $('.form_table1').fadeIn(1000);
	 $('.submit').fadeIn(1000);
	 $('.form_table2').hide("fast");
	 $('.form_table3').hide("fast");
	 $('.form_table4').hide("fast");
	 $('.submitt').hide("fast");
	 $('.submittt').hide("fast");
	 $('.submitttt').hide("fast");
	 });
 $('#staff').click(function(){
	 $('.form_table2').fadeIn(1000);
	 $('.submitt').fadeIn(1000);
	 $('.form_table1').hide("fast");
	 $('.form_table3').hide("fast");
	 $('.form_table4').hide("fast");
	 $('.submit').hide("fast");
	 $('.submittt').hide("fast");
	 $('.submitttt').hide("fast");
	 });
 $('#sem').click(function(){
	 $('.form_table3').fadeIn(1000);
	 $('.submittt').fadeIn(1000);
	 $('.form_table2').hide("fast");
	 $('.form_table1').hide("fast");
	 $('.form_table4').hide("fast");
	 $('.submitt').hide("fast");
	 $('.submit').hide("fast");
	 $('.submitttt').hide("fast");
	 });
 $('#nhis').click(function(){
	 $('.form_table4').fadeIn(1000);
	 $('.submitttt').fadeIn(1000);
	 $('.form_table2').hide("fast");
	 $('.form_table3').hide("fast");
	 $('.form_table1').hide("fast");
	 $('.submitt').hide("fast");
	 $('.submittt').hide("fast");
	 $('.submit').hide("fast");
	 });
});
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
	  <li class="page_title">Pharmacy Unit</li><br>
	  <li><a href="index.php">Main Page</a></li><br>
      <li><a href="mopd_dashboard.php">Drugs</a></li><br>
	  <li><a href="mopd_payment_verification.php">Payment Verification</a></li><br>
      <li><a href="mopd_cart.php">Billing</a></li><br>
      <li><a href="logout.php">Logout</a></li><br>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
	<div class="product_details">										
	 <hr style='width: 800px; margin-left: 0px; height: 6px; background-color: #14BCEB'><br>
	 <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15); font-style: normal'>Your Cart</h2>
	  <div id="personalty">
	    <ul>
		  <li id="gen">Public</li>
		  <li id="staff">Staff</li>
		  <li id="sem">Bapt. Pastor</li>
		  <li id="nhis">NHIS</li>
	   </ul><br><br>
	   <h2 style="font-style: normal; color: #880000; font-family: arial black">Click the button above to print your receipt</h2>
	  </div><br><br>
	 <div class="form_table1" style="display: none">
	   <form action="mopd_receipt.php" method="POST" id="jsform" class="form1" target="_blank">
	    <section style="float: left"><label style="margin-left: 20px; font-family: Arial Rounded MT Bold; font-size: 14px">Patient Name:</label><input type="text" id="userareaa" name="patient_name" maxlength="25"></section>
		<section style="float: right; margin-right: 20px"><label style="font-family: Arial Rounded MT Bold; font-size: 14px">Hosp. File No:</label><input type="text"  id="userareaa" name="hospital_no" maxlength="10"></section>
	   </form><br><br>
	   </div>
	    <div class="form_table2" style="display: none">
	   <form action="mopd_staff_receipt.php" method="POST" id="jsform2" class="form2"  target="_blank">
	    <section style="float: left"><label style="margin-left: 20px; font-family: Arial Rounded MT Bold; font-size: 14px">Staff Name:</label><input type="text" id="userareaa" name="staff_name" maxlength="25"></section>
		<section style="float: right; margin-right: 20px"><label style="font-family: Arial Rounded MT Bold; font-size: 14px">Staff ID:</label><input type="text"  id="userareaa" name="staff_id" maxlength="10"></section>
	   </form><br><br>
	   </div>
	    <div class="form_table3" style="display: none">
	   <form action="mopd_sem_receipt.php" method="POST" id="jsform3" class="form3"  target="_blank">
	    <section style="float: left"><label style="margin-left: 20px; font-family: Arial Rounded MT Bold; font-size: 14px">Seminarian Name:</label><input type="text" id="userareaa" name="sem_name" maxlength="25"></section>
		<section style="float: right; margin-right: 20px"><label style="font-family: Arial Rounded MT Bold; font-size: 14px">Seminarian ID:</label><input type="text"  id="userareaa" name="sem_id" maxlength="10"></section>
	   </form><br><br>
	   </div>
	    <div class="form_table4" style="display: none">
	   <form action="mopd_nhis_receipt.php" method="POST" id="jsform4" class="form4" target="_blank">
	    <section style="float: left"><label style="margin-left: 20px; font-family: Arial Rounded MT Bold; font-size: 14px">Staff (NHIS) Name:</label><input type="text" id="userareaa" name="nhis_name" maxlength="25"></section>
		<section style="float: right; margin-right: 20px"><label style="font-family: Arial Rounded MT Bold; font-size: 14px">Staff(NHIS) ID:</label><input type="text"  id="userareaa" name="nhis_id" maxlength="10"></section>
	   </form><br><br>
	   </div>
	   <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="6" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>ID</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Name</b></td>
		<td width="22%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Category</b></td>
		<td width="8%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Type</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Qty Avail.</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Selling Price</b></td>
		<td width="9%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Quantity</b></td>
		<td width="7%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Total</b></td>
		<td width="9%" style='background-color:#C5DFFA; font-family: arial black; font-size: 14px'><b>Remove</b></td>
		</tr>
		<?php echo $cartOutput; ?>
	    <?php
	    echo $msg;
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
	    <input type="button" onclick="document.getElementById('jsform').submit();" class="submit" style="display:none" value="Print Receipt">
		<label class="add_more_drugs" style="float: right"><a href='mopd_dashboard.php'>Add More Drugs</a></label>
		<input type="button" onclick="document.getElementById('jsform2').submit();" class="submitt" style="display:none" value="Print Receipt (Staff)">
		<input type="button" onclick="document.getElementById('jsform3').submit();" class="submittt" style="display:none" value="Print Receipt (Seminarian)">
		<input type="button" onclick="document.getElementById('jsform4').submit();" class="submitttt" style="display:none" value="Print Receipt (NHIS)"><br><br>
	     <?php echo "<h2 class='cart'><p>Your Billing Total: N" . $cartTotal. "</p></h2>"; ?>
	   <h2 class="empty"><a href='mopd_cart.php?cmd=emptycart'>Click here to empty your cart</a></h2>
          <hr style='width: 800px; margin-left: 0px; height: 6px; background-color: #14BCEB'><br>
	<!-- end .margin --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
