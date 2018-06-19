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


// check the url is set and exit in the database
$dynamic_lists = "";
if (isset($_GET['product_id'])){
	$product_id = $_GET['product_id'];
	// use this var to check if the ID exist in the database, if yes, show the product details, if no
	// give message
	$sql6 = "SELECT * FROM `products` WHERE `product_id`='$product_id' LIMIT 1";
	$check6 = mysqli_query($dbconnect, $sql6) or die (mysqli_error($dbconnect));
	$resultCount6 = mysqli_num_rows($check6);
	if ($resultCount6>0){
		while($row=mysqli_fetch_array($check6)){
		$product_name=$row["product_name"];
		$rate=$row["rate"];
		$date_of_receipt=$row["date_of_receipt"];
		$category=$row["category"];
		$sub_category=$row["sub_category"];
		$product_price=$row["price"];
		$quantity_available=$row["quantity_available"];
		$expiring_date=$row["expiring_date"];
		$date_added=$row["date_added"];
		$drug_type=$row["drug_type"];
		
		}
		}else{
		$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>That item does not exit. Please try again with another ID</p>";
		}
		} else {
		$msg= "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>No product in the system with that ID</p>";
}
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title><?php echo $product_name; ?></title>
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
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
    <!-- end .sidebar1 --></div>
  <div class="margin" id="content">
  <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'><?php echo $product_name; ?></h2>
	 <br>
	<div class="product_details">
	<h2 class='add_more2'><p><?php echo "Drug ID:" . " " . "[" . $product_id. "]"; ?></p></h2>
	<h2 class='add_more4'><p><?php echo "Expiry Date:" . " " . "[" .$expiring_date. "]"; ?></p></h2>
	<h2 class='add_more3'><p><?php echo "Quantity Available:" . " " . "[" .$quantity_available. "]"; ?></p></h2><br><br><br><br>
	 <table width="480px" style="margin-left: auto; margin-right: auto" cellpadding="10"  cellspacing="0" border="1">
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Drug Name</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $product_name; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>Selling Price</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo "N". $product_price; ?></b></td>
		</tr>
		<tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Category</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $category; ?></b></td>
		</tr>
		<tr>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px;  font-size: 14px'><b>Sub Category</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $sub_category; ?></b></td>
		</tr>
		<tr>
	    <td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b>Type</b></td>
		<td width="50%" style='background-color:#C5DFFA; font-family: Adobe Heiti Std R; padding-left: 20px; font-size: 14px'><b><?php echo $drug_type; ?></b></td>
		</tr>
	    <?php
	    echo $msg;
	    ?>
	 </table><br>
    </div>
	 <form action="requisition.php" method="post" name="Cart2">
	 <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id; ?>">
	 <center><input type="submit" value="Add To Requisition" name="AddToRequisition" id="AddToCart"></center>
     </form><br>
	<!-- end .margin --></div>
  <!-- end .container --></div>
 <?php
  include_once "footer.php";
  ?>
</body>
</html>
