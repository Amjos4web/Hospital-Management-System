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


// get the block for products listing
$product_list = "";

$page = "";


// $page = $_GET['page'];
// if ($page == "" || $page == "1"){
	// $page1 = 0;
// } else {
	// $page1 = ($page*14)-14;
// }

$sql2 = "SELECT * FROM `products` ORDER BY date_added DESC LIMIT 30";
$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
$resultCount2=mysqli_num_rows($check2); //count the out amount 
if($resultCount2>0){
	while($row=mysqli_fetch_array($check2)){
	$product_id=$row["product_id"];
	$product_name=$row["product_name"];
	$product_price=$row["price"];
	$quantity_available=$row["quantity_available"];
	$date_added=$row["date_added"];
	$category=$row["category"];
	$drug_type=$row["drug_type"];
	
	$product_list .= "<tr>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $product_id . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $product_name . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $category . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $drug_type . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $quantity_available . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $product_price . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $date_added . "</td>";
	$product_list .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . "<a href='pharmacy_store_products.php?product_id=$product_id' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Details</a></td>";
	$product_list .= "</tr>";
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no product in the store yet</p>";
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Add New Drugs Page</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
	 $(".product_lists h2").click(function(){
	 $(".product_lists").fadeOut(1000);
	 $(".product_lists h2").fadeOut(1000);
	 $(".product_form").fadeIn(1000);
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
	  <li><a href="pharmacy_store_dashboard.php">Homepage</a></li><br>
      <li><a href="pharmacy_store_addnew.php">Add Drugs Items</a></li><br>
	  <li><a href="requisition.php">Requisition</a></li><br>
	  <li><a href="invoice_note.php">Invoice Notebook</a></li><br>
      <li><a href="logout.php">Logout</a></li><br>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; color: #CECECE'>Welcome <?php echo $name."!" . " "; ?>What would you like to do today?</h1>
	     <h2 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Pharmacy Available Stocks</h2>
	    </div><br>
	  <div class="product_lists">
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Category</b></td>
		<td width="7%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Type</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Manage Quantity</b></td>
		<td width="8%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Unit Price</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date Added</b></td>
		<td width="6%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Details</b></td>
		</tr>
		<?php echo $product_list; ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>Prof
		</tr-->
		</table>
	    </div><br>
		  <?php
			// this is for counting page
			// $sql3 = "SELECT * FROM `products` ORDER BY date_added DESC";
			// $check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			// $resultCount3=mysqli_num_rows($check3); //count the out amount 
			
			// $a = $resultCount3/14;
			// $a = ceil($a);
			   // for($b=1;$b<=$a;$b++)
			   // {
				   

			   // }
			 ?>
		
	   <!-- end .content --></div>
	   
	  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>