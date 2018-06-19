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
	$storeType=$row["storeType"];
	
	$product_list .= "<tr>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $product_id . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $product_name . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $category . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $storeType . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $quantity_available . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $product_price . "</td>";
	$product_list .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R;'>" . $date_added . "</td>";
	$product_list .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R;'>" . "<a href='pharmacy_store_products.php?product_id=$product_id' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>Details</a></td>";
	$product_list .= "</tr>";
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no product in the store yet</p>";
}


// parse the form data and add the inventory to the system
if (isset($_POST['add'])){
	 $product_name = htmlspecialchars($_POST['product_name']);
	 $product_price = htmlspecialchars($_POST['product_price']);
	 $category = htmlspecialchars($_POST['category']);
	 $dosageForm = htmlspecialchars($_POST['dosageForm']);
	 $commonDosage = htmlspecialchars($_POST['commonDosage']);
	 $storeType = htmlspecialchars($_POST['storeType']);
	 $packSize = htmlspecialchars($_POST['packSize']);
	 $grn = htmlspecialchars($_POST['grn']);
	 $therapeuticCategory = htmlspecialchars($_POST['therapeuticCategory']);
	 $quantity_available = htmlspecialchars($_POST['quantity_available']);
	 $manu_add = htmlspecialchars($_POST['manu_add']);
	 $manu = htmlspecialchars($_POST['manu']);
	 $pur_date = htmlspecialchars($_POST['pur_date']);
	 $invoice_no = htmlspecialchars($_POST['invoice_no']);
	 $rate = htmlspecialchars($_POST['rate']);
	 $expiring_date = htmlspecialchars($_POST['expiring_date']);
	 $supplier_add = htmlspecialchars($_POST['supplier_add']);
	 $supplier_company = htmlspecialchars($_POST['supplier_company']);
	 $supplier_email = htmlspecialchars($_POST['supplier_email']);
	 $supplier_phone = htmlspecialchars($_POST['supplier_phone']);
	 $supplier_website = htmlspecialchars($_POST['supplier_website']);
	 $date_added = date('Y-m-d');
	 
	 if (empty($product_name && $pur_date && $manu_add && $dosageForm && $commonDosage && $storeType && $packSize && $grn && $therapeuticCategory && $supplier_add && $supplier_company && $supplier_phone && $supplier_email && $category  && $quantity_available && $invoice_no && $rate) == false){
		 // check whether product name is an identical match to another in the system
		 $sql3 = "SELECT `product_id` FROM `products` WHERE `product_name`='$product_name' LIMIT 1";
		 $check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
		 $productMatch=mysqli_num_rows($check3); //count the out amount 
		 if($productMatch == 0){
			// add product to the database
			$sql4 = "INSERT INTO `products` (`product_name`, `price`, `category`, `dosageForm`, `invoice_no`,`rate`, `commonDosage`, `storeType`, `packSize`, `grn`, `therapeuticCategory`, `cost_price`, `manu_add`, `manu`,`pur_date`, `supplier_company`, `supplier_add`, `supplier_email`, `supplier_phone`, `supplier_website`, `quantity_available`, `expiring_date`, `date_added`) 
			VALUES ('$product_name', '$product_price', '$category', '$dosageForm', '$invoice_no', '$rate', '$commonDosage', '$storeType', '$packSize', '$grn', '$therapeuticCategory', '$cost_price', '$manu_add','$manu','$pur_date', '$supplier_company', '$supplier_add', '$supplier_email', '$supplier_phone', '$supplier_website', '$quantity_available', '$expiring_date', '$date_added')";
			$check4 = mysqli_query($dbconnect, $sql4) or die (mysqli_error($dbconnect));
			header ('location: pharmacy_store_addnew.php');
			exit();
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Product already in the store</p>";
		} else
		$msg = "<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>Please fill in the required fields (*)</p>";
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

$(document).ready(function(){
	$('#formb').click(function(){
	$('#formB').toggle();
	});
	$('#formc').click(function(){
	$('#formC').toggle();
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
	  <?php include_once "pharmacy_nav.php"; ?>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="product_lists">
	  <h1 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Drugs Items</h1><br>
        <h2 class='add_more'><p>+ Click Here To Add New Drug Item</p></h2><br>
		<table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Category</b></td>
		<td width="7%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Type</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Manage Quantity</b></td>
		<td width="8%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Selling Price</b></td>
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
		<div class="product_form">
		 <form action="pharmacy_store_addnew.php" method="post" enctype="multipart/form-data">
		 <div class="form_data">
		 <h3 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Add New Drug Items </h3>
		 <?php echo $msg; ?>
		 <center><h3 class="heading_text">Form A (Product Details)</h3></center>
		 <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Category</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><select name="category" class="userarea">
		   <option value='Medication'>Medication</option>
		   <option value='Medication Consumable'>Medication Consumable</option>
		   <option value='Otics of Ophtalmics'>Otics of Ophtalmics</option>
		   <option value='Intravenous Fluids'>Intravenous Fluids</option>
		   <option value='Liquid Preparation'>Liquid Preparation</option>
		   <option value='Dermatologicals'>Dermatologicals</option>
		   <option value='Surgery'>Surgery</option></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Product Name</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="product_name"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Dosage Form</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><select name="dosageForm" class="userarea">
		   <option value='Syrup'>Syrup</option>
		   <option value='Injection'>Injection</option>
		   <option value='Tablets and Capsules'>Tablets and Capsules</option>
		   <option value='None'>None</option></td>
		  </tr>
		   <tr>
		   <td width="30%"><label>Common Dosage</label></td>
		   <td width="70%"><input type="text" id="userarea" name="commonDosage"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Cost Price</label></td>
		   <td width="70%"><input type="text" id="userarea" name="product_price"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Selling Price</label></td>
		   <td width="70%"><input type="text" id="userarea" name="selling_price"></td>
		  </tr>
		   <tr>
		   <td width="30%"><label>Rate</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="rate"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Expiry Date</label></td>
		   <td width="70%"><input type="text" id="userarea" name="expiring_date" placeholder="YYYY-MM-DD"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Store Type</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><select name="storeType" class="userarea">
		   <option value='General Store'>General store</option>
		   <option value='GRA'>GRA</option></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Pack Size</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="packSize"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Quantity</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="quantity_available"></td>
		  </tr>
	      <tr>
		   <td width="30%"><label>GRN</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="grn"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Therapeutic Category</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="therapeuticCategory"></td>
		  </tr>
		  </table>
		  </div><br><br>
			<center><h3 class="heading_text" id="formb" title="click here">Form B (Manufacturer Details)</h3></center>
			 <div class="form_data" id="formB" style="display: none;">
			<table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Manufacturer</label></td>
		   <td width="70%"><input type="text" id="userarea" name="manu"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Manufacturer Address</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><textarea type="textarea" cols="44" rows="3" id="userarea5" name="manu_add"></textarea></td>
		  </tr>
		  </table>
		  </div><br><br>
		   
			<center><h3 class="heading_text" id="formc">Form C (Supplier Details)</h3></center>
			<div class="form_data" id="formC" style="display: none;">
			<table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		   <tr>
		   <td width="30%"><label>Drug Supplier Name</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_company"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Drug Supplier Address</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_add"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Drug Supplier Phone No</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_phone"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Drug Supplier Email Address</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="email" id="userarea" name="supplier_email"></td></td>
		  </tr>
		  <td width="30%"><label>Drug Supplier Website</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_website"></td></td>
		  </tr>
		   <tr>
		   <td width="30%"><label>Purchase Date</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="pur_date" placeholder="YYYY-MM-DD"></td>
		  </tr>
		   <tr>
		   <td width="30%"><label>Invoice No</label><label style="color: #880000; float: right">*</label></td>
		   <td width="70%"><input type="text" id="userarea" name="invoice_no"></td>
		  </tr>
         </table><br>		  
		 </div>
	    
		<input type="submit" value="&gt; &gt; Add This item Now &lt; &lt;" name="add" id="login222">
		</form>
		</div>
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