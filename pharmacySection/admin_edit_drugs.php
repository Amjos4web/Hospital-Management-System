<?php
session_start();
ob_start();
if(!isset($_SESSION['emaill'])){
	header('location: admin_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql = "SELECT * FROM `admin` WHERE `admin_email`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));;
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$admin_password=$row["admin_password"];
	}
}else{
$msg="<p style='color: red; text-align: center'>You have no Information yet in the Database</p>";
}

// error display configuration
error_reporting(E_ALL);
ini_set('display_errors','1');


// edit item for admin
if (isset($_GET['pid'])){
	$targetID = $_GET['pid'];
	// get the block for products listing
	$sql2 = "SELECT * FROM `products` WHERE `product_id`='$targetID LIMIT 1'";
	$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
	$resultCount2=mysqli_num_rows($check2); //count the out amount 
	if($resultCount2>0){
		while($row=mysqli_fetch_array($check2)){
			$pid=$row["product_id"];
			$product_name=$row["product_name"];
			$product_price=$row["price"];
			$category=$row["category"];
			$sub_category=$row["sub_category"];
			$quantity_available=$row["quantity_available"];
			$expiring_date=$row["expiring_date"];
			$date_added=$row["date_added"];
			$supplier_add=$row["supplier_add"];
			$supplier_company=$row["supplier_company"];
			$supplier_email=$row["supplier_email"];
			$cost_price=$row["cost_price"];
			$drug_type=$row["drug_type"];
			$supplier_phone=$row["supplier_phone"];
			$supplier_website=$row["supplier_website"];
			$manu=$row["manu"];
			$manu_add=$row["manu_add"];
			$pur_date=$row["pur_date"];
			$invoice_no=$row["invoice_no"];
			$rate=$row["rate"];
			$date_of_receipt=$row["date_of_receipt"];
		}
	}else{
	$msg="<p style='color: red; text-align: center'>Sorry! Error has occurred. Please try again</p>";
	}
}

// parse the form data and add the inventory to the system
 if (isset($_POST['makeChange'])){
	 $product_name = htmlspecialchars($_POST['product_name']);
	 $product_price = htmlspecialchars($_POST['product_price']);
	 $category = htmlspecialchars($_POST['category']);
	 $sub_category = htmlspecialchars($_POST['sub_category']);
	 $quantity_available = htmlspecialchars($_POST['quantity_available']);
	 $manu_add = htmlspecialchars($_POST['manu_add']);
	 $manu = htmlspecialchars($_POST['manu']);
	 $cost_price = htmlspecialchars($_POST['cost_price']);
	 $drug_type = htmlspecialchars($_POST['drug_type']);
	 $pur_date = htmlspecialchars($_POST['pur_date']);
	 $invoice_no = htmlspecialchars($_POST['invoice_no']);
	 $date_of_receipt = htmlspecialchars($_POST['date_of_receipt']);
	 $rate = htmlspecialchars($_POST['rate']);
	 $expiring_date = htmlspecialchars($_POST['expiring_date']);
	 $supplier_add = htmlspecialchars($_POST['supplier_add']);
	 $supplier_company = htmlspecialchars($_POST['supplier_company']);
	 $supplier_email = htmlspecialchars($_POST['supplier_email']);
	 $supplier_phone = htmlspecialchars($_POST['supplier_phone']);
	 $supplier_website = htmlspecialchars($_POST['supplier_website']);
	 $drug_type = htmlspecialchars($_POST['drug_type']);
	 $date_added = date('Y-m-d');
	 
	 if (empty($_POST) == false){
			// place the image in the folder
			// $name = $_FILES['fileToUpload']['name']; 
			// $tmp_name = $_FILES['fileToUpload']['tmp_name']; 
			// $type = $_FILES['fileToUpload']['type']; 
			// $size = $_FILES['fileToUpload']['size']; 
			// list($width, $height, $typeb, $attr) = getimagesize($tmp_name); 

			
			// if($width>160 || $height>160) 
			// { 
			// echo "$name dimensions exceed the 160x160 pixel limit."; 
			// die(); 
			// } 

			// if(!( 
			// $type=='image/jpeg' ||
			// $type=='image/jpg' ||
			// $type=='image/png' 
			// )) { 
			// echo "$type is not an acceptable format."; 
			// die(); 
			// } 

			// if($size>'20000') { 
			// echo "$name is over 20KB. Please make it smaller."; 
			// die(); 
			// }
			// if(!get_magic_quotes_gpc()){ 
			// $name = addslashes($name); 
			// } 
			// $extract = fopen($tmp_name, 'r'); 
			// $content = fread($extract, $size); 
			// $content = addslashes($content); 
			// fclose($extract);
            // if ($_FILES['fileToUpload']['tmp_name'] != ""){
				// //Place image in the folder
			   // $newname="$product_id.jpg";
			   // move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"../pharmacySection/files/$newname");
			$sql3 = "UPDATE `products` SET `product_name`='$product_name', `price`='$product_price',`rate`='$rate', `invoice_no`='$invoice_no', `manu`='$manu', `date_of_receipt`='$date_of_receipt', `category`='$category',`cost_price`='$cost_price', `drug_type`='$drug_type', `sub_category`='$sub_category', `quantity_available`='$quantity_available', `pur_date`='$pur_date', `supplier_add`='$supplier_add', `supplier_company`='$supplier_company', `supplier_phone`='$supplier_phone', `supplier_email`='$supplier_email', `supplier_website`='$supplier_website', `expiring_date`='$expiring_date', `date_added`='$date_added' WHERE `product_id`='$pid'";
	        $check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
			header('location: admin_manage_drugs.php');
			exit();
	        } else 
			$msg = "<p style='color: #880000; text-align: center'>Please fill in the required fields</p>";
	 }
?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
 <title>Products Page|<?php echo $product_name; ?></title>
<script src="js/jqueryy.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
	 <?php include_once "admin_nav.php"; ?>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="product_lists">
	  <h1 style='text-align: center; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Edit Drugs Section</h1><br>
	    </div><br>
		<div class="product_form2">
		 <form action="" method="post" enctype="multipart/form-data">
		 <div class="form_data">
		 <h3 style='color: brown; font-size: 22px; font-style: normal; text-align: center; font-family: monospace'>Edit Drug Item|<?php echo $product_name; ?><h3>
		 <?php
		 echo $msg;
		 ?>
		   <table width="450px" style="margin-left: auto; margin-right: auto;" cellpadding="5" cellspacing="0" border="1">
		  <tr>
		   <td width="30%"><label>Drug Name</label></td>
		   <td width="70%"><input type="text" id="userarea" name="product_name" value="<?php echo $product_name; ?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Selling Price</label></td>
		   <td width="70%"><input type="text" id="userarea" name="product_price" value="<?php echo $product_price; ?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Cost Price</label></td>
		   <td width="70%"><input type="text" id="userarea" name="cost_price" value="<?php echo $cost_price; ?>" ></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Quantity Available</label></td>
		   <td width="70%"><input type="text" id="userarea" name="quantity_available" value="<?php echo $quantity_available; ?>"></td>
		  </tr>
		   <tr>
		   <td width="30%"><label>Date Of Receipt</label></td>
		   <td width="70%"><input type="text" id="userarea" name="date_of_receipt" placeholder="YYYY-MM-DD" value="<?php echo $date_of_receipt; ?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Purchase Date</label></td>
		   <td width="70%"><input type="text" id="userarea" name="pur_date" placeholder="YYYY-MM-DD" value="<?php echo $pur_date; ?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Expiry Date</label></td>
		   <td width="70%"><input type="text" id="userarea" name="expiring_date" placeholder="YYYY-MM-DD" value="<?php echo $expiring_date; ?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Type</label></td>
		   <td width="70%"><input type="text" id="userarea" name="drug_type" value="<?php echo $drug_type; ?>"></></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Manufacturer</label></td>
		   <td width="70%"><input type="text" id="userarea" name="manu" value="<?php echo $manu; ?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Manufacturer Address</label></td>
		   <td width="70%"><textarea type="textarea" cols="44" rows="3" id="userarea5" name="manu_add"><?php echo $manu_add; ?></textarea></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Category</label></td>
		   <td width="70%"><input type="text" id="userarea" name="category" value="<?php echo $category; ?>"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Sub Category</label></td>
		   <td width="70%"><input type="text" id="userarea" name="sub_category" value="<?php echo $sub_category; ?>"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Drug Supplier Company</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_company" value="<?php echo $supplier_company; ?>"></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Drug Supplier Address</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_add" value="<?php echo $supplier_add; ?>"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Drug Supplier Phone No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_phone" value="<?php echo $supplier_phone; ?>"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Drug Supplier Email Address</label></td>
		   <td width="70%"><input type="email" id="userarea" name="supplier_email" value="<?php echo $supplier_email; ?>"></td></td>
		  </tr>
		  <td width="30%"><label>Drug Supplier Website</label></td>
		   <td width="70%"><input type="text" id="userarea" name="supplier_website" value="<?php echo $supplier_website; ?>"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Rate</label></td>
		   <td width="70%"><input type="text" id="userarea" name="rate" value="<?php echo $rate; ?>"></td></td>
		  </tr>
		  <tr>
		   <td width="30%"><label>Invoice No</label></td>
		   <td width="70%"><input type="text" id="userarea" name="invoice_no" value="<?php echo $invoice_no; ?>"></td></td>
		  </tr>
         </table><br>		  
		   <input type="hidden" name="thisID" value="<?php echo $targetID; ?>">
		   <input type="submit" value="&gt; &gt; Make Changes &lt; &lt;" name="makeChange" id="login222">
		   </form>
		  </div>
	</div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>